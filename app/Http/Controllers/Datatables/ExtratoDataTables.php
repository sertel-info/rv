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

    public function transactionsAnyData(Request $request){
        $assinante = Auth::user()->assinante;
        $transactions = $assinante->atualizacoesCreditos()
                                  ->selectRaw("DATE_FORMAT(DATE(created_at), '%d/%m/%Y') as date, TIME(created_at) as time, value as value")
                                  ->get();
        return Datatables::of($transactions)->make(true);
    }

}
