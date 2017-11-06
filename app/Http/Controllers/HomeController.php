<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class HomeController extends Controller
{
    
    function index(Request $request)
    {	
    	
        try {
    		
    		JWTAuth::setToken($request->cookie('token'));
            if (! $user = JWTAuth::authenticate()) {
                return redirect()->route('auth.login');
            }

            if($user->role == 0)
                return view("admin");
            else if($user->role == 1){
                return view("cliente");
            } else {
                return redirect()->route('auth.login');
            }

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return redirect()->route('auth.login');

        }
        	
    }
}
