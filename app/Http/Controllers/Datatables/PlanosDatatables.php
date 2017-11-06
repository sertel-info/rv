<?php

namespace App\Http\Controllers\Datatables;

use ReactTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planos\Planos;

class PlanosDatatables extends Controller {
   
    public function anyData(Request $request){
        $planos = Planos::selectRaw('*, MD5(id) as id_md5');

        $rt = new ReactTable();
        $rt->setData($planos->forPage($request->curr_page, $request->itens_per_page)->get());
        $rt->setTotalRecords(Planos::count());
        return $rt->getResponse();
    }

}