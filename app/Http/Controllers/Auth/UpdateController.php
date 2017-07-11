<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller{

    public function fullValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function passwordValidator(array $data){
        return Validator::make($data, ['password' => 'required|min:6|confirmed']);
    }

    public function simpleValidator(array $data, $ignore=null){

        return Validator::make($data, ['name' => 'required|max:255',
                                       'email' => 'required|email|max:255|unique:users,email'.($ignore !== null ? ','.$ignore : '')]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function update(array $data)
    {
        return User::update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role'=>$data['role']
            //'assinante_id'=>isset($data['assinante']) ? $data['assinante'] : null
        ]);
    }

}
