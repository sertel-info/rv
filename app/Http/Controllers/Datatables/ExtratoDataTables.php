<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use DB;

class ExtratoDataTables extends Controller
{
    public function anyData($id)
	{
	    $linha = \App\Models\Linhas\Linhas::where(DB::raw('md5(linhas.id)'), $id)
	                                    ->with('autenticacao')
	                                    ->with('configuracoes')
	                                    ->with('did')
	                                    ->first();


	    $identificadores_linhas = $this->getIdentificadoresLinha($linha);

	    $gravacoes = \App\Models\Cdr::where(function ($query) use ($identificadores_linhas){
	                                            $query->whereIn('dst', $identificadores_linhas)
	                                                   ->orWhere(function($query) use ($identificadores_linhas){
	                                                        $query->whereIn('src', $identificadores_linhas);
	                                                   });
	                                   
	                          })->orderBy('uniqueid', 'desc')
	    						->get();

	    return Datatables::of($gravacoes)->make(true);
	}

	public function getIdentificadoresLinha($linha){
        $array_ids = array();

        if(isset($linha->did))
            array_push($array_ids, $linha->did->extensao_did);

        if(isset($linha->autenticacao))
            array_push($array_ids, $linha->autenticacao->login_ata);

        if(isset($linha->configuracoes))
            array_push($array_ids, $linha->configuracoes->callerid);

        $identificadores_linhas = array_unique($array_ids);

        $identificadores_linhas = array_filter($identificadores_linhas, function($el){
            return $el !== null && !empty($el);
        });

       return $identificadores_linhas;
    }
}
