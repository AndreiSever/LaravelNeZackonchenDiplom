<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'name', 'email', 'password','secondname','thirdname','activate','login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'login','password', 'remember_token',
    ];
    public function roles() {
		return $this->belongsToMany('App\Role');
    }
    public function groups() {
		return $this->belongsToMany('App\Group','GroupUsers');
  }
  public function disciplines()
    {
        return $this->hasMany('App\Discipline');
    }
}
