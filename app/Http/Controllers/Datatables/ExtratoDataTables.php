<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use Auth;
use App\Helpers\AGIClasses\Numero;

class ExtratoDataTables extends Controller
{
    public function anyData(Request $request)
	{
        $id = $request->id;

	    $linha_query = Auth::user()->assinante->linhas();

        if($id !== null){
            $linha_query->where(DB::raw('md5(linhas.id)'), $id);
        }

        $linhas = $linha_query->with('autenticacao')
                                ->with('configuracoes')
                                ->with('did')
                                ->get();                  

        $query = \App\Models\Cdr::select("*", DB::raw('SEC_TO_TIME(billsec) as billsec_time'),
                                              DB::raw("IF(type='sainte', accountcode, src) as origem"),
                                              DB::raw("DATE_FORMAT(DATE(calldate), \"%d/%m/%Y\") as date"),
                                              DB::raw("TIME_FORMAT(TIME(calldate), \"%H:%i:%s\") as time"));
                                   
        $filtros = $request->filters;

        $identificadores_linhas = $this->getIdentificadoresLinhas($linhas);

        $query->where(function($query) use ($filtros, $identificadores_linhas, $linhas){
            
            if(!empty($filtros['destino'])){
                
                $query->where(function($query) use ($filtros){
                    $query->where("dst", $filtros['destino']);
                
                    $query->orWhere(function($query) use ($filtros){
                        $query->whereIn("type", ["internas", "entrante"]);
                        $query->where('peeraccount', "=", $filtros['destino']);
                    });
                });  
               
               
            } 

            if(!empty($filtros['origem'])){
                $query->where(function($query) use ($filtros){

                    $query->where("src", $filtros['origem']);

                    $query->orWhere(function($query) use ($filtros){
                        $query->whereIn("type", ["sainte", "internas"]);
                        $query->where("accountcode", "=", $filtros['origem']);
                    });
                });
            } 
        });

        $query->where(function($query) use ($linhas){
            $query->whereIn("accountcode", $linhas->pluck("autenticacao.login_ata")->toArray());
            $query->orWhereIn("peeraccount", $linhas->pluck("autenticacao.login_ata")->toArray());
        });

        //dd($query->toSql(), $query->getBindings());

        if(!empty($filtros['data_min'])){
            $data_min_obj = \DateTime::createFromFormat("d/m/Y", $filtros['data_min']);
            $query->where(DB::raw('DATE(calldate)'), '>=', $data_min_obj->format("Y-m-d"));
        }

        if(!empty($filtros['data_max'])){
            $data_max_obj = \DateTime::createFromFormat("d/m/Y", $filtros['data_min']);
            $query->where(DB::raw('DATE(calldate)'), '<=', $data_max_obj->format("Y-m-d"));
        }

        if(!empty($filtros['duracao_min'])){
            list($horas, $min, $sec) = explode(":",$filtros['duracao_min']);
            $seconds = ($horas*60*60)+($min*60)+$sec;
            $query->where('billsec', '>=', $seconds);
        }

        if(!empty($filtros['duracao_max'])){
            list($horas, $min, $sec) = explode(":",$filtros['duracao_max']);
            $seconds = ($horas*60*60)+($min*60)+$sec;
            $query->where('billsec', '<=', $seconds);
        }

        if(!empty($filtros['hora_min'])){
            $query->where(DB::raw('TIME(calldate)'), '>=', $filtros['hora_min']);
        }

        if(!empty($filtros['hora_max'])){
            $query->where(DB::raw('TIME(calldate)'), '<=', $filtros['hora_max']);
        }

        if(!empty($filtros['tipo_chamada'])  && $filtros['tipo_chamada'] !== 'todos'){
            $query->where('type', '=', $filtros['tipo_chamada']);
        }

        if(!empty($filtros['tipo_destino']) && $filtros['tipo_destino'] !== 'todos'){
            $query->where('dst_type', '=', $filtros['tipo_destino']);
        } else {
            $query->where('dst_type', '<>', "")
                  ->where('dst_type', '<>', "aplicacao");
        }

        $query->where('disposition', 'ANSWERED')
              ->orderBy('id', 'desc')->get();
                                    
	    return Datatables::of($query)->make(true);

	}

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


}
