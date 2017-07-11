<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use App\User;
use App\Models\Assinantes\Assinantes;
use Illuminate\Http\Request;
use Auth;
use Session;

class MorphController {

	public function exec(Request $request){
		
		if(Auth::user()->role == 0){
			
			$admin = Auth::user();

			$user = Assinantes::whereRaw("md5(id) = '".$request->id."'")->first()->acesso;

			Auth::login($user);
			
			session(['is_morphed'=>true, 'morpher'=>md5($admin->id)]);

		
		} else {

			SessionController::flashMessage("danger ", "Erro", "Você não tem permissão para realizar esta ação");

		}

		return redirect()->route("index");

	}

	public function unmorph(Request $request){

		$admin_id = Session::get("morpher");

		Session::forget('is_morphed');
		Session::forget('morpher');

		$admin = User::whereRaw("md5(id) = '".$admin_id."'")->first();
		Auth::login($admin);
		
		return redirect()->route("rv.assinantes.manage");

	}
}
