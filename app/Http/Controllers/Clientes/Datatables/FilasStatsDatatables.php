<?php

namespace App\Http\Controllers\Clientes\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReactTable;
use JWTAuth;

class LinhasStatsDatatables extends Controller {
	/*
	*
	* Retorna os status das filas do cliente
	*
	*/

	public function anydata(Request $request){
		$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
		$filas = $assinante->filas;

		/*
		*
		* $fila_stats guarda os stats das filas
		* inicialmente tem somente o id, o nome original Ex. (Suporte)
		* e o nome no asterisk (Suporte-3) de cada fila
		*/
		$filas_stats = $fila->map(function($fila){ return ["nome_orig"=>$fila->nome, 
														   "nome"=>$fila->nome."-".$assinante->id,
														   "id"=>$fila->id] });


		foreach($filas_stats as &$fila){
			exec("asterisk -x 'queue show ".$fila['nome']."'", $output);
			dd(preg_match("/([0-9]+)s\s(holdtime|talktime)/", $fila, $stats));
		}


	}
}