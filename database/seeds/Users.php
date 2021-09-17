<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
                'name'=>'admin'
            ],
            [
                'name'=>'teacher'
            ],
            [
                'name'=>'student'
            ]
        ]);
        
        DB::table('users')->insert([
            [
                'login'=>'user',
                'name'=>'Подкопаев',
                'secondname'=>'Андрей',
                'thirdname'=>'Игоревич',
                'password'=>bcrypt('12345')
            ]
        ]);
        DB::table('RoleUsers')->insert([
            [
                'id_role'=>'1',
                'id_users'=>'1'
            ]
        ]);
    }
}
