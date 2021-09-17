<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Role;
use App\Discipline;
use DB;
class editTeacherForAdmin extends Controller
{
    //
    public function show() {
		return view('teacherAdmin');
  }
  public function select(){
    $role= DB::table('roles')->where('name','teacher')->get();
    $arr=[];
    $role_user= DB::table('role_user')->where('role_id',$role[0]->id)->get();
    if ($role_user->count()<>0) {
      foreach($role_user as $user){
        $users = User::where('id',$user->user_id)->get();
        $users[0]->role='teacher';
        if ( $users[0]->activate==1){
          $users[0]->activate = 'Активирован';
        }else{
          $users[0]->activate = 'Не активирован';
        }
        $arr[]=$users[0];
        //$users->merge($users[0]);
        
      }
    }  
    
    //$role= Role::where('name','teacher')-get();
   //$group = User::with('role')where()All()->toJson();
   return json_encode($arr);
  }

  public function add(Request $request){
    $datas=$request->json()->all();
    foreach($datas as $data){
      $add = Group::create([
          'number_group' => $data['name'],
      ]);
    }
    return json_encode($add);
  }

  public function delete(Request $request){
    $datas=$request->json()->all();     
    foreach($datas as $data){
      $GroupUsers= DB::table('GroupUsers')->where('group_id',$data['id'])->get();
      if ($GroupUsers->count()<>0) {
        foreach($GroupUsers as $user){
          DB::table('role_user')->where('user_id',$user->user_id)->delete();
          DB::table('GroupUsers')->where('user_id',$user->user_id)->delete();
          DB::table('users')->where('id',$user->user_id)->delete();
        }
      }      
      DB::table('group')->where('id',$data['id'])->delete();
    }
  }

  public function edit(Request $request){

    $datas=$request->json()->all();
    $changeId=[];
    foreach($datas as $data){
      $user = User::find($data['id']);
      $roles = Role::where('name','=',$data['role'])->get();//find($data['']);
      
      $user->secondname = $data['secondname'];
      $user->name = $data['name'];
      $user->thirdname = $data['thirdname'];
      if ($data['activate']=='Активирован'){
        $user->activate = 1;
      }else{
        $user->activate = 0;
      }
      $user->save();
      
      $rolesId=$user->roles()->get();
      
      if ($rolesId[0]->id<>$roles[0]->id) $changeId = $data['id'];
      $user->groups()->updateExistingPivot($rolesId[0]->id,['group_id'=>$roles[0]->id]);
    }
    // $mes=array(
    //    'mes'=>'change',
    //    'user'=>$changeId
    // );
    return json_encode($changeId);
    // return $datas;
  }
  public function selectChild(Request $request){

    $data=$request->json()->all();
    $collect= DB::table('disciplines')
        ->where('user_id','=',$data['id'])->select('id','name')->get();
    // foreach($collect as $data){
    //   if ($data->activate==1){
    //     $data->activate = 'Активирован';
    //   }else{
    //     $data->activate = 'Не активирован';
    //   }
    // }
    return json_encode($collect);
  }
  public function editChild(Request $request){

    $datas=$request->json()->all();
    foreach($datas as $data){
      //$discipline = Discipline::where('id',$data['id'])->get();
      DB::table('disciplines')
            ->where('id',$data['id'])
            ->update(array('name' => $data['discipline']));
      // $discipline[0]->name=$data['discipline'];
      // return $discipline[0];
      // $discipline[0]->save();
    }
  }
  public function deleteChild(Request $request){
    $datas=$request->json()->all();
    foreach($datas as $data){
      $user= User::find($data['id']);
      $user->groups()->detach(Group::where('number_group', $data['number_group'])->first());
      $user->roles()->detach(Role::where('name', 'student')->first());
      User::destroy($data['id']);
    }
    //return $datas;
  }
}
