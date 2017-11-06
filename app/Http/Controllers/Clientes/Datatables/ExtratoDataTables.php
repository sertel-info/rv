<?php

namespace App\Http\Controllers\Clientes\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use JWTAuth;
use App\Helpers\AGIClasses\Numero;
use App\Helpers\Extrato\CdrQueryFilterApplier;
use App\Helpers\Extrato\ExtratoFormatedQueryGetter;
use ReactTable;

class ExtratoDataTables extends Controller
{
    public function ligacoesAnyData(Request $request)
	{
        $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
	    $linha_query = $assinante->linhas();

        /*$id = $request->id;
        if($id !== null){
            $linha_query->where(DB::raw('md5(linhas.id)'), $id);
        }*/

        $linhas = $linha_query->with('autenticacao')->get();  
        
        $query = ExtratoFormatedQueryGetter::get($linhas);
        $filters = json_decode($request->filters, 1);
        $filtered_query = CdrQueryFilterApplier::getFilteredQuery($query, $filters);

	    $rt = new ReactTable();
        $ligacoes = $filtered_query->get();
        $rt->setTotalRecords($ligacoes->count());
        $rt->setData($ligacoes->forPage($request->curr_page, $request->itens_per_page));
        return $rt->getResponse();

	} 

    public function transactionsAnyData(Request $request){
        $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
        $transactions = $assinante->atualizacoesCreditos()
                                  ->selectRaw("DATE_FORMAT(DATE(created_at), '%d/%m/%Y') as date, TIME(created_at) as time, value as value");

        $rt = new ReactTable();
        $rt->setData($transactions->forPage($request->curr_page, $request->itens_per_page)->get());
        $rt->setTotalRecords($assinante->atualizacoesCreditos()->count());
        return $rt->getResponse();
    }

}
