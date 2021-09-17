<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = 'group';
    public $timestamps = false;
    protected $fillable = [
        'number_group'
    ];

    public function disciplines() {
		return $this->belongsToMany('App\Discipline'); // role_user
	}
    public function users() {
		return $this->belongsToMany('App\User','GroupUsers','group_id','user_id'); // role_user
	}
}
