<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assinantes\Assinantes;
use Datatables;
use DB;
use ReactTable;

class AssinantesDataTables extends Controller
{

/**
 * Displays datatables front end view
 *
 * @return \Illuminate\View\View
 */

/*public function index(){
    return $this->render('users');
}*/

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData(Request $request)
{
    $assinantes = Assinantes::select(DB::raw("IF(tipo,concat(nome, ' ',sobrenome),nome_fantasia) as nome_completo,
                                                        IF(tipo=1,'PF','PJ') as tipo,
                                                        plano,
                                                        id
                                                    "))
                                    ->with(["planos"=>function($query){
                                            $query->select("nome", "id");
                                     }])
                                    ->with("acesso");
                                    
    $rt = new ReactTable();
    $rt->setData($assinantes->forPage($request->curr_page, $request->itens_per_page)->get());
    $rt->setTotalRecords(Assinantes::count());
    return $rt->getResponse();
}

}