<?php

namespace App\Http\Controllers;
use App\Models\Assinantes\Assinantes;
use App\Models\Linhas\Linhas;
use App\Models\Cdr;
use Illuminate\Http\Request;
use JWTAuth;

class DashboardController {

	public function getAdminDashboardStats(){
		try{
		
			$assinantes_num = Assinantes::count();
			$linhas_num = Linhas::count();

			$hoje = new \DateTime();
			$ligacoes_hoje = Cdr::where('calldate', '>=', $hoje->format('Y-m-d'))->count();
			$offset = $hoje->format('w') != 0 ? intval($hoje->format('w'))-1 : 6;
			$inicio_semana = $hoje->sub(new \DateInterval("P".$offset."D"));
			$ligacoes_semana = Cdr::where('calldate', '>=', $inicio_semana->format('Y-m-d 00:00:00'))
															->groupBy('uniqueid')
															->count();
		
		} catch(\Exception $e){
			return response('', 500);
		}

		return response()->json(["assinantes"=>$assinantes_num,
								 "linhas"=>$linhas_num,
								 "lig_hoje"=>$ligacoes_hoje,
								 "lig_semana"=>$ligacoes_semana], 200);
	}

	public function getAdminHeaderData(Request $request){
		try{
			$admin = JWTAuth::toUser($request->cookie('token'));
			return response()->json(['username'=>$admin->name] , 200);
		} catch(\Exception $e){
			return response('', 500);
		}
	}
}