<?php

namespace App\Http\Controllers\Clientes\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assinantes\Assinantes;
use DB;
use JWTAuth;
use ReactTable;

class GruposAtendimentoDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData(Request $request)
{	
	$assinante = JWTAuth::toUser($request->cookie("token"))->assinante;

	$grupos_query = $assinante
						  ->grupos()
						  ->withIdMd5()
						  ->with(['linhas'=>function($query){
						  		$query->orderBy('posicao', 'asc');
						  		$query->select('nome');
						  }]);

	$grupos = $grupos_query->forPage($request->curr_page, $request->itens_per_page)->get();
	
	$grupos->map(function($grupo){
		$grupo->nome_linhas = implode(", ", $grupo->linhas->pluck('nome')->toArray());
		return $grupo;
	});


    $rt = new ReactTable();
    $rt->setData($grupos);
    $rt->setTotalRecords($assinante->grupos->count());
    return $rt->getResponse();
}

}