<?php

namespace App\Http\Controllers\Clientes\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReactTable;
use JWTAuth;

class LinhasStatsDatatables extends Controller {
	/*
	*
	* Retorna os status das linhas do cliente
	*
	*/
	
	public function anyData(Request $request){
		try{
			$assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
			$linhas = $assinante->linhas()->with("autenticacao")->get();
			$regex_peer_cmd = implode('|', $linhas->pluck('autenticacao.login_ata')->toArray());
			$regex_inuse_cmd = implode('\|', array_map(function($linha){ return "^".$linha; }, 
													   $linhas->pluck('autenticacao.login_ata')->toArray()));

			/* array linhas stats criado para guardar os status das linhas
			*  inicialmente só tem o nome e o login_ata de cada uma e
			*  indexado pelo login_ata
			*/
			$linhas_stats = $linhas->mapWithKeys(function($linha){
						return [$linha->autenticacao->login_ata=>
									["login_ata"=>$linha->autenticacao->login_ata, "nome"=>$linha->nome]];
			})->toArray();
			
			exec("rasterisk -x 'sip show peers like ".$regex_peer_cmd."'", $op_peers);
			exec("rasterisk -rx 'sip show inuse' | grep \"".$regex_inuse_cmd."\"", $op_inuse);

			/* remove a primeira e a última linha pois não serão usadas
			*  o array_values seguinte organiza os índices o array
			*/
			unset($op_peers[0]);
			unset($op_peers[count($op_peers)]); 
			$op_peers = array_values($op_peers);
			
			/*
			* Verifica status dos peers
			*/
			foreach($op_peers as $linha){		
				//remove os espaços em excesso da linha
				$no_spaces = preg_replace("/\s\s+/", ' ', $linha);
				//pega o ramal, parseando o retorno do tipo 2000/2000
				$ramal = explode("/", explode(" ", $no_spaces)[0])[0];
				
				/* Procura por algo do tipo OK (10 ms), UNKNOWN ou Unmonitored
				*  O que achar será seu status
				*  Se não achar nenhum o status fica como "erro"
				*/
				$regex_status = "/((OK)\s\([0-9]+\sms\))|(UNKNOWN)|(Unmonitored)|(UNREACHABLE)/";
				if(preg_match($regex_status, $no_spaces, $matches) &&
					isset($linhas_stats[$ramal])){
					$linhas_stats[$ramal]['status'] = end($matches);
				} else {
					$linhas_stats[$ramal]['status'] = "erro";
				}
			}

			/*
			* Verifica se o peer está em uso, este status
			* irá sobrepor o status anterior
			*/
			foreach($op_inuse as $use){
				$no_spaces = preg_replace("/\s\s+/", ' ', $use);
				$ramal = explode(" ", $no_spaces)[0];
				if(!preg_match("/0\/0\/0/", $no_spaces)){
					$linhas_stats[$ramal]['status'] = "IN USE";
				}
			}

			
			/*para teste REMOVEEER*/
			$arr = json_decode('[{"login_ata":"2000","nome":"dudu","status":"OK"},{"login_ata":"5020","nome":"Sertelx","status":"UNREACHABLE"},{"login_ata":"1151","nome":"Diego 1151","status":"UNKNOWN"},{"login_ata":"2020","nome":"magma-2127","status":"UNKNOWN"}]');
			$rt = new ReactTable();
			$rt->setData(collect($arr)->forPage($request->curr_page, $request->itens_per_page));
			$rt->setTotalRecords(count($arr));
			return $rt->getResponse();
			/*-----------*/


			$rt = new ReactTable();
			$rt->setData(collect($linhas_stats)->forPage($request->curr_page, $request->itens_per_page));
			$rt->setTotalRecords(count($linhas_stats));
			return $rt->getResponse();
			
		} catch(\Exception $e){
			return response('', 500);
		}
	}
}