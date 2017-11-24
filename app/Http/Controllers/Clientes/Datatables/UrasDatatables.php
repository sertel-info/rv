<?php

namespace App\Http\Controllers\Clientes\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReactTable;
use JWTAuth;

class UrasDatatables extends Controller {
	
	public function anyData(Request $request){
		$assinante = JWTAuth::toUser($request->cookie("token"))->assinante;

		$uras = $assinante->uras();
		
		$rt = new ReactTable();
		$rt->setData($uras->forPage($request->curr_page, $request->itens_per_page)->get());
		$rt->setTotalRecords($uras->count());
		return $rt->getResponse();
	}	
}
