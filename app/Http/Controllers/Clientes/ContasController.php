<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Auth\UpdateController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;

class ContasController extends Controller {

	public function edit(Request $request){
		$user = Auth::user();
		return view("rvc.conta.edit", ['user'=>$user]);
	}


	public function update(Request $request){
		$update_ctrl = new UpdateController();

		$validator = $update_ctrl->simpleValidator($request->only('email', 'name'), Auth::id());
		$validator->validate();

		if(!$validator->fails()){
			
			$user = Auth::user();
			$user->name = $request->name;
			$user->email = $request->email;
			$user->save();
			
			SessionController::flashMessage("success", "Sucesso ", "Conta atualizada com sucesso");

			return redirect()->route('rvc.conta.edit');
		}

	}

	public function editPassword(Request $request){
		$user = Auth::user();
		return view("rvc.conta.edit_password", ['user'=>$user]);
	}

	public function updatePassword(Request $request){
		$update_ctrl = new UpdateController();
		$user = Auth::user();

		if(!password_verify($request->password_old, $user->password)){
			SessionController::flashMessage("danger", "Erro ", "Sua senha antiga não está correta");
			return redirect()->back();
		}

		$validator = $update_ctrl->passwordValidator($request->only('password', 'password_confirmation'));
		$validator->validate();

		if(!$validator->fails()){
			$user->password = $request->password;
			$user->save();

			SessionController::flashMessage("success", "Sucesso ", "Senha alterada com sucesso !");
			return redirect()->route('rvc.conta.edit');
		}
	}
}
