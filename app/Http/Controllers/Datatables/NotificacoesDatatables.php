<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notificacoes\Notificacoes;
use Datatables;
use DB;
use Auth;

class NotificacoesDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{	
	$case_events = $this->getCaseEventsString();
	$notificacoes = Notificacoes::select(DB::raw("*"), DB::raw($case_events))->withIdMd5()->get();

    return Datatables::of($notificacoes)
    				 ->make(true);
}

public function getCaseEventsString(){

	$str = "(CASE escutar_evento ".
		   " WHEN 'CreditosAcabando' THEN 'Créditos Acabando'".
		   " WHEN 'CreditosRemovidos' THEN 'Créditos Removidos'".
		   " WHEN 'CreditosAdicionados' THEN 'Créditos Adicionados'".
		   " END)".
		   " as escutar_evento";

	return $str;
}

}