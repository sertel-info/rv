<?php

namespace App\Http\Controllers\Clientes\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assinantes\Assinantes;
use ReactTable;
use DB;
use JWTAuth;

class SaudacoesDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData(Request $request)
{	
	$assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
	
	$sau_query = $assinante->saudacoes();

    $rt = new ReactTable();
	$rt->setData($sau_query->forPage($request->curr_page, $request->itens_per_page)->get());
	$rt->setTotalRecords($sau_query->count());
	return $rt->getResponse();
}

}