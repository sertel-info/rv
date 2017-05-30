<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gravacoes;
use Datatables;
use DB;
use Auth;
use App\User;

class GravacoesDataTables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{	
   		$linhas = $this->getUsuario()->assinante->linhas;
    	$linhas_callerid = $linhas->pluck('configuracoes.callerid')->toArray();
    	$linhas_login_ata = $linhas->pluck('autenticacao.login_ata')->toArray();
    	$linhas_dids = $linhas->pluck('dids.extensao_did')->toArray();

    	$identificadores_linhas = array_unique(array_merge($linhas_callerid, $linhas_login_ata, $linhas_dids));

    	$identificadores_linhas = array_filter($identificadores_linhas, function($el){
    		return $el !== null && !empty($el);
    	});

    	$gravacoes = Gravacoes::select("*",DB::raw("MD5(gravacoes.id) as id_md5"))
    				 ->leftjoin('cdr', 'cdr.uniqueid', '=', 'gravacoes.unique_id')
    				 ->where(function ($query) use ($identificadores_linhas){
			                $query->where('cdr.disposition', '=', 'ANSWERED')
			                      ->where(function($query) use ($identificadores_linhas){
			                      		$query->whereIn('callerid', $identificadores_linhas)
			                      			   ->orWhere(function($query) use ($identificadores_linhas){
			                      			   		$query->whereIn('exten', $identificadores_linhas);
			                      			   })
			                      			   ->orWhere(function($query) use ($identificadores_linhas){
			                      			   		$query->whereIn('src', $identificadores_linhas);
			                      			   })
			                      			   ->orWhere(function($query) use ($identificadores_linhas){
			                      			   		$query->whereIn('dst', $identificadores_linhas);
			                      			   });
			                      });
			          })
    				 ->orderBy('gravacoes.id', 'desc')
    				 ->get();

    return Datatables::of($gravacoes)->make(true);
}

public function getUsuario(){
	return User::where("id", Auth::id())->complete()->first();
}

}