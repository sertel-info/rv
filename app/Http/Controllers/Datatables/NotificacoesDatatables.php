<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notificacoes\Notificacoes;
use Datatables;
use DB;
use Auth;
use ReactTable;

class NotificacoesDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData(Request $request)
{	
	$case_events = "(CASE escutar_evento ".
				    " WHEN 'CreditosAcabando' THEN 'Créditos Acabando'".
				    " WHEN 'CreditosRemovidos' THEN 'Créditos Removidos'".
				    " WHEN 'CreditosAdicionados' THEN 'Créditos Adicionados'".
				    " END)".
				    " as escutar_evento";

	$notificacoes = Notificacoes::select(DB::raw("*"), DB::raw($case_events))->withIdMd5();
	
	$rt = new ReactTable();
    $rt->setData($notificacoes->forPage($request->curr_page, $request->itens_per_page)->get());
    $rt->setTotalRecords(Notificacoes::count());

    return $rt->getResponse();
}


}