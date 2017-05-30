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

	    $ligacoes = \App\Models\Cdr::whereIn('dst', $identificadores_linhas)
                                    ->orWhere('accountcode', '=', $linha->autenticacao->login_ata)
                                    ->where('disposition', 'ANSWERED')
                                    ->orderBy('id', 'desc')
                                    ->get();

	    return Datatables::of($ligacoes)->make(true);
	}

	public function getIdentificadoresLinha($linha, $identificadores = array('d', 'l', 'c')){
        $array_ids = array();

        if(isset($linha->did) && in_array('d', $identificadores))
            array_push($array_ids, $linha->did->extensao_did);

        if(isset($linha->autenticacao) && in_array('l', $identificadores))
            array_push($array_ids, $linha->autenticacao->login_ata);

        if(isset($linha->configuracoes) && in_array('c', $identificadores))
            array_push($array_ids, $linha->configuracoes->callerid);

        $identificadores_linhas = array_unique($array_ids);

        $identificadores_linhas = array_filter($identificadores_linhas, function($el){
            return $el !== null && !empty($el);
        });

       return $identificadores_linhas;
    }
}
