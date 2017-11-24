<?php

namespace App\Http\Controllers\Clientes\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReactTable;
use JWTAuth;

class FilasStatsDatatables extends Controller {
	/*
	*
	* Retorna os status das filas do cliente
	*
	*/

	public function anydata(Request $request){
		$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
		$filas = $assinante->filas;

		try{
			/*
			*
			* $fila_stats guarda os stats das filas
			* inicialmente tem somente o id, o nome original Ex. (Suporte)
			* e o nome no asterisk (Suporte-3) de cada fila
			*/
			$filas_stats = $filas->map(function($fila) use ($assinante){ return ["nome_orig"=>$fila->nome, 
															   "nome"=>$fila->nome."-".$fila->id,
															   "id"=>$fila->id]; })
								  ->toArray();


			$filas_stats = array_map(function($fila){
					exec("asterisk -x 'queue show ".$fila['nome']."'", $output);
					//dd($output[0]);
					preg_match("/([0-9]+)s\sholdtime/", $output[0], $holdtime);
					preg_match("/([0-9]+)s\stalktime/", $output[0], $talktime);
					

					$fila['talktime'] = $talktime[1];
					$fila['holdtime'] = $holdtime[1];

					return $fila;
			}, $filas_stats);

			$rt = new ReactTable();
			$rt->setData(collect($filas_stats)->forPage($request->curr_page, $request->itens_per_page));
			$rt->setTotalRecords(count($filas_stats));
			return $rt->getResponse();
		} catch (\Exception $e){
			return response('', 500);
		}
	}
}