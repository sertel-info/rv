<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use Auth;
use App\Helpers\AGIClasses\Numero;
use App\Helpers\Extrato\CdrQueryFilterApplier;
use App\Helpers\Extrato\ExtratoFormatedQueryGetter;

class ExtratoDataTables extends Controller
{
    public function anyData(Request $request)
	{
        $id = $request->id;
        
	    $linha_query = Auth::user()->assinante->linhas();

        if($id !== null){
            $linha_query->where(DB::raw('md5(linhas.id)'), $id);
        }

        $linhas = $linha_query->with('autenticacao')->get();  
        
        $query = ExtratoFormatedQueryGetter::get($linhas);
        $filtered_query = CdrQueryFilterApplier::getFilteredQuery($query, $request->filters);

	    return Datatables::of($filtered_query)->make(true);

	}

/*
	public function getIdentificadoresLinhas($linhas){
        $array_ids = array();
        
        foreach($linhas as $linha){

            if(isset($linha->did))
                array_push($array_ids, $linha->did->extensao_did);

            if(isset($linha->autenticacao))
                array_push($array_ids, $linha->autenticacao->login_ata);

            if(isset($linha->configuracoes))
                array_push($array_ids, $linha->configuracoes->callerid);   
        
        }
      
        $identificadores_linhas = array_unique($array_ids);

        $identificadores_linhas = array_filter($identificadores_linhas, function($el){
            return $el !== null && !empty($el);
        });

       return $identificadores_linhas;
    }
*/

}
