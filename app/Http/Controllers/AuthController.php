<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
use App\Role;
use Validator;
use App\Group;
class AuthController extends Controller
{
    //
    public function showLogin() {
		return view('login');
	}
	public function showRegister() {
        $group = Group::All();
        $group= $group->toArray();//collect($group)->all();
        $arr = array(
            'group'=>$group
        );
		return view('register',$arr);
    }
    public function showRegisterTeacher() {
        return view('registerTeacher');
    }
    public function register(Request $request) {
        $messages = array(
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique'=>'Такой логин уже существует.',
            'confirmed'=>'Пароли не совпадают.',
            'min'=>'Минимально количество - :min символов.',
            'max'=>'Максимальное количество символов - :max.'
        );
        $v = Validator::make($request->all(), [
            'login' => ['required','unique:users', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'secondname' => ['required', 'string', 'max:255'],
            'thirdname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'number_group' => ['required','not_in:-']
        ],$messages);
        $group = Group::where("number_group",'=',$request->number_group)->get();
        //dump($group);| $group->isEmpty()
        if ($v->fails() || $group->isEmpty())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->only('login','name','secondname','thirdname'));
        }
        $data=$request->all();
        $user=User::create([
            'login' => $data['login'],
            'name' => $data['name'],
            'secondname' => $data['secondname'],
            'thirdname' => $data['thirdname'],
            'activate' => 0,
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'student')->first());
        $user->groups()->attach(Group::where('number_group', $request->number_group)->first());
        return redirect()->intended('login');
    }

    public function registerTeacher(Request $request) {
        $messages = array(
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique'=>'Такой логин уже существует.',
            'confirmed'=>'Пароли не совпадают.',
            'min'=>'Минимально количество - :min символов.',
            'max'=>'Максимальное количество символов - :max.'
        );
        $v = Validator::make($request->all(), [
            'login' => ['required','unique:users', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'secondname' => ['required', 'string', 'max:255'],
            'thirdname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ],$messages);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->only('login','name','secondname','thirdname'));
        }
        $data=$request->all();
        $user=User::create([
            'login' => $data['login'],
            'name' => $data['name'],
            'secondname' => $data['secondname'],
            'thirdname' => $data['thirdname'],
            'activate' => 0,
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'teacher')->first());
        return redirect()->intended('login');
	}
	public function authenticate(Request $request) {
		$array = $request->all();
        $remember = $request->has('remember');
        $val=Auth::attempt([
            'login'=>$array['login'],
            'password'=>$array['password'],
            'activate'=>1
            ], $remember );
		if($val)		
        {
            return redirect()->intended('/');
        }
		return redirect()->back()
					->withInput($request->only('login','remember'))
					->withErrors([
                                'message'=>'Введенные данные либо неверны, либо аккаунт не активирован администратором',
								]);
						
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->intended('login/');
    }

}
