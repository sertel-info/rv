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

        $ligacoes = \App\Models\Cdr::select("*", DB::raw('SEC_TO_TIME(billsec) as billsec_time'),
                                                 DB::raw("IF(type='sainte', accountcode, src) as src"))
                                    ->whereIn('dst', $identificadores_linhas)
                                    ->orWhere('accountcode', '=', $linha->autenticacao->login_ata)
                                    ->where('disposition', 'ANSWERED')
                                    ->orderBy('id', 'desc')
                                    ->get();
       
        return Datatables::of($ligacoes)->make(true);
	    
        /*$query = \App\Models\Cdr::select("*", DB::raw('SEC_TO_TIME(billsec) as billsec_time'));
                                   
        $filtros = $request->filters;

        $query->where(function($query) use ($filtros, $identificadores_linhas, $linha){
            if(!empty($filtros['destino'])){
                $query->where('dst', 'like', '%'.$filtros['destino'].'%');
            } 
            
            $query->whereIn('dst', $identificadores_linhas);
            
            if(!empty($filtros['origem'])){
                $query->where('src', 'like', "'%".$filtros['origem']."%'");
                $query->where('accountcode', '=', $linha->autenticacao->login_ata);                
            } 
            
            $query->orWhere('accountcode', '=', $linha->autenticacao->login_ata);                
        
        });
       

        if(!empty($filtros['data_min'])){
            $query->where('calldate', '>=', $filtros['data_min']);
        }

        if(!empty($filtros['data_max'])){
            $query->where('calldate', '<=', $filtros['data_max']);
        }

        if(!empty($filtros['duracao_min'])){
            $query->where('billsec', '>=', $filtros['duracao_min']);
        }

        if(!empty($filtros['duracao_max'])){
            $query->where('billsec', '<=', $filtros['duracao_max']);
        }

        if(!empty($filtros['valor_min'])){
            $query->where('cost', '<=', $filtros['valor_min']);
        }

        if(!empty($filtros['valor_max'])){
            $query->where('cost', '<=', $filtros['valor_max']);
        }

        $query
                                    ->where('disposition', 'ANSWERED')
                                    ->orderBy('id', 'desc')
                                    ->get();
                                    
	    return Datatables::of($query)->make(true);*/

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
