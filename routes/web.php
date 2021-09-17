<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['middleware'=>['web','auth'], function(){
    return view('default');
}]);
Route::post('/logout',['middleware'=>['web','auth'],'as'=>'logout','uses'=>'AuthController@logout']);
Route::group(['prefix' => 'student','middleware'=>['web','auth']],function () {
    Route::get('/discipline',['as'=>'discipline'], function () {
        return view('disciplineStudent');
    });
    Route::get('/task',['as'=>'task'], function () {
        return view('tasksStudent');
    });
    Route::get('/message',['as'=>'message'], function () {
        return view('outMessageStudent');
    });
});
Route::group(['prefix' => 'admin','middleware'=>['web','auth']],function () {
    //////////////////////////////////
    Route::get('/editGroup',['as'=>'editGroup','uses'=>'editGroupForAdmin@show']);
    
    Route::post('/editGroup/select',['uses'=>'editGroupForAdmin@select']);
    Route::post('/editGroup/add',['uses'=>'editGroupForAdmin@add']);
    Route::post('/editGroup/delete',['uses'=>'editGroupForAdmin@delete']);
    Route::post('/editGroup/edit',['uses'=>'editGroupForAdmin@edit']);

    Route::post('/editGroup/deleteChild',['uses'=>'editGroupForAdmin@deleteChild']);
    Route::post('/editGroup/editChild',['uses'=>'editGroupForAdmin@editChild']);
    Route::post('/editGroup/selectChild',['uses'=>'editGroupForAdmin@selectChild']);
    //////////////////////////////////////
    Route::get('/editTeacher',['as'=>'editTeacher','uses'=>'editTeacherForAdmin@show']);
    Route::post('/editTeacher/select',['uses'=>'editTeacherForAdmin@select']);
    Route::post('/editTeacher/add',['uses'=>'editTeacherForAdmin@add']);
    Route::post('/editTeacher/delete',['uses'=>'editTeacherForAdmin@delete']);
    Route::post('/editTeacher/edit',['uses'=>'editTeacherForAdmin@edit']);

    Route::post('/editTeacher/deleteChild',['uses'=>'editTeacherForAdmin@deleteChild']);
    Route::post('/editTeacher/editChild',['uses'=>'editTeacherForAdmin@editChild']);
    Route::post('/editTeacher/selectChild',['uses'=>'editTeacherForAdmin@selectChild']);
    ////////////////////////////////////
    Route::get('/editAdmins',['as'=>'editAdmins','uses'=>'editAdminsForAdmin@show']);
});


//Auth::routes();
Route::group(['middleware'=>['web','guest']], function(){
    Route::get('/login',['as'=>'login','uses'=>'AuthController@showLogin']);
    Route::post('/login',['as'=>'authenticate','uses'=>'AuthController@authenticate']);

    

    Route::get('/register',['as'=>'registerStudentShow','uses'=>'AuthController@showRegister']);
    Route::post('/register',['as'=>'registerStudent','uses'=>'AuthController@register']);

    Route::get('/register2', ['as' => 'registerTeacherShow','uses'=>'AuthController@showRegisterTeacher']);
    Route::post('/register2',['as'=>'registerTeacher','uses'=>'AuthController@registerTeacher']);
    //Route::get('/add',['uses'=>'adminController@show','as'=>'admin_index']); 'guest'
});
// Route::group(['prefix'=>'admin1','middleware'=>['web','auth']], function(){
//     Route::get('/',['uses'=>'adminController@show','as'=>'admin_index']);
//     Route::get('/add',['uses'=>'adminController@show','as'=>'admin_index']);
// });
// Route::get('/', 'HomeController@index')->name('home');
