<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class LinhasController extends Controller
{	
	/*
	* Retorna a lista de linhas do assinante
	* no formato [$id => $nome]
	*/
	public function getList(Request $request){
		try{
			$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
			$linhas = $assinante->linhas()->select("id", "nome")->get();
			
			$linhas_obj = $linhas->mapWithKeys(function($linha){
							return [$linha->id=>$linha->nome];
						});

			return response()->json(["linhas"=>$linhas_obj->toArray()], 200);
		} catch (\Exception $e){
			return response('', 500);
		}
	}

}