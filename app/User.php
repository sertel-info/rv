<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'assinante_id', 'role', 'status'
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

    public function notificacoes(){
        return $this->hasMany('App\Models\Notificacoes\NotificacoesUsers', 'user_id', 'id');
    }

    public function setStatusAttribute($value){
        $this->attributes['status'] = (Boolean)$value;
    }

}
