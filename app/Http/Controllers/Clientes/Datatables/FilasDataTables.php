<?php

namespace App\Http\Controllers\Clientes\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ReactTable;
use App\Models\Filas;
use JWTAuth;

class FilasDataTables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData(Request $request)
{	
	$assinante = JWTAuth::toUser($request->cookie("token"))->assinante;

    $filas_query = $assinante->filas()
						  ->with(['linhas'=>function($query){
						  		$query->orderBy('posicao', 'asc');
						  		$query->select('nome');
						  }]);
	
	$filas = $filas_query->forPage($request->curr_page, $request->itens_per_page)->get();
	$filas->map(function($fila){
		$fila['nome_linhas'] = implode(", ", $fila->linhas->pluck("nome")->toArray());
		return $fila;
	});	

	unset($filas['linhas']);

    $rt = new ReactTable();
	$rt->setData($filas);
	$rt->setTotalRecords($filas_query->count());
	return $rt->getResponse();
}

}