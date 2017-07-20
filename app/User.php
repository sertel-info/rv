<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'assinante_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function assinante(){
        return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id', 'id');
    }

    public function setPasswordAttribute($value){
        return $this->attributes['password'] = bcrypt($value);
    }

    public function getRoleAttribute($value){
        return intval($value);
    }

    public function notification(){
        return $this->hasMany('App\Models\Notifications', 'user_id', 'id');
    }

}
