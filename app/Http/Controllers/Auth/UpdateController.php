<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function validator(array $data, $id){
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
    }

    public function update($user, $data){

        $user->update(["email"=>$data['email'],
                       "password"=>$data['password']]);
        
    }

}
