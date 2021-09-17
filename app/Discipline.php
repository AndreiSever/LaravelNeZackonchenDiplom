<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    //\
    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function groups() {
		return $this->belongsToMany('App\Group'); // role_user
	}
    
}
