<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;

class AuthUserController {

	public function signup(Request $request){
		
		$validator = Validator::make($request->all(), [
            "name"=>"required",
			"email"=>"required|email|unique:users",
			"password"=>"required|min:6",
			"password_confirm"=>"required_with:password|same:password"
        ]);

		if($validator->fails()){
			return response()->json(['validation_errors'=>$validator->errors()], 400);
		}

		$user = new User([
			"name"=>$request->name,
			"email"=>$request->email,
			"password"=> bcrypt($request->password)
		]);

		$user->save();

		return response()->json([
			'status'=>1
		]);
	}

	public function signin(Request $request){

		$validator = Validator::make($request->all(), [
			"email"=>"required|email",
			"password"=>"required|min:6"
        ]);

		$credentials = $request->only(['email', 'password']);

        try{

        	if(!$token = JWTAuth::attempt($credentials)){
        		return response()->json([
        			"errors"=>["Dados Inválidos"]
        		], 400);
        	}

        } catch (\Exception $e){
        	return response()->json([
        			"errors"=>"Um erro inesperado ocorreu, por favor tente novamente"
        	], 500);
        }

        return response()->json([
        	'token'=>$token
        ], 200);
	}

	public function login(Request $request){
		
		try {
    		
    		JWTAuth::setToken($request->cookie('token'));
            if (!$user = JWTAuth::authenticate()) {
                return view("auth.login");
            }

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return view("auth.login");

        }

		return redirect()->route('/');
	}

	public function signout(Request $request){
		try{
			
			$token = $request->cookie("token");
			JWTAuth::invalidate($token);

		} catch (\Exception $e){
			//
		}
		
        return redirect()->route("auth.login");
	}

	public function morph(Request $request){

        try{
			
			$user = \App\User::find($request->id);
			$morphed_id = JWTAuth::toUser($request->cookie('token'))->id;
			$this->signout($request);

        	if(!$token = JWTAuth::fromUser($user)){
        		return response()->json([
        			"errors"=>["Dados Inválidos"]
        		], 400);
        	}

        } catch (\Exception $e){
        	return response()->json([
        			"errors"=>["Um erro inesperado ocorreu, por favor tente novamente"]
        	], 500);
        }

        return response()->json([
        	'token'=>$token,
        	'morphed'=>$morphed_id
        ], 200);

	}

	public function unmorph(Request $request){
		try{
			
			$this->signout($request);
			$user = \App\User::find($request->cookie('morphed'));
			
        	if(!$token = JWTAuth::fromUser($user)){
        		return response()->json([
        			"errors"=>["Dados Inválidos"]
        		], 400);
        	}

        } catch (\Exception $e){
        	return response()->json([
        			"errors"=>["Um erro inesperado ocorreu, por favor tente novamente"]
        	], 500);
        }

        return response()->json([
        	'token'=>$token
        ], 200);
	}
}