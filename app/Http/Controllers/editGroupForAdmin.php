<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Role;
use DB;
use App\Http\Controllers\Response;
class editGroupForAdmin extends Controller
{
    //
    public function show() {
		  return view('groupAdmin');
    }
    public function select(){
     return $group = Group::All()->toJson();
     //return json_encode($group);
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
      foreach($datas as $data){
        $group = Group::find($data['id']);
        $group->number_group = $data['number_group'];
        $group->save();
      }
      // return $datas;
    }
    public function selectChild(Request $request){

      $data=$request->json()->all();
      $collect= DB::table('users')
          ->join('GroupUsers', 'users.id', '=', 'GroupUsers.user_id')
          ->join('group', 'GroupUsers.group_id', '=', 'group.id')
          ->where('group.id','=',$data['id'])->select(
          'users.id',
          'users.secondname',
          'users.name',
          'users.thirdname',
          'users.activate',
          'group.number_group'
          )->get();
      foreach($collect as $data){
        if ($data->activate==1){
          $data->activate = 'Активирован';
        }else{
          $data->activate = 'Не активирован';
        }
      }
      return json_encode($collect);
    }
    public function editChild(Request $request){

      $datas=$request->json()->all();
      $changeId=[];
      foreach($datas as $data){
        $user = User::find($data['id']);
        $group = Group::where('number_group','=',$data['number_group'])->get();//find($data['']);
        
        $user->secondname = $data['secondname'];
        $user->name = $data['name'];
        $user->thirdname = $data['thirdname'];
        if ($data['activate']=='Активирован'){
          $user->activate = 1;
        }else{
          $user->activate = 0;
        }
        $user->save();
        
        $groupId=$user->groups()->get();
        
        if ($groupId[0]->id<>$group[0]->id) $changeId = $data['id'];
        $user->groups()->updateExistingPivot($groupId[0]->id,['group_id'=>$group[0]->id]);
      }
      // $mes=array(
      //    'mes'=>'change',
      //    'user'=>$changeId
      // );
      return json_encode($changeId);
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
