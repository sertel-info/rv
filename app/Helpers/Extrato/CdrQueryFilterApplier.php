<?php

namespace App\Helpers\Extrato;
use DB;

/*
 Classe que recebe o parametro "query" e adiciona as cláusulas de filtros de acordo com
 o parametro "filtros"
*/

class CdrQueryFilterApplier {

    public static function getFilteredQuery ($query, $filtros) {

        $query->where(function($query) use ($filtros){
            
            if(!empty($filtros['origem'])){
                $origem = preg_replace('/[^0-9]/', '', $filtros['origem']);

                $query->where(function($query) use ($origem){
                    $query->where("src", $origem);
                    $query->orWhere("src", "like", "__".$origem);
                    $query->orWhere(function($query) use ($origem){
                        $query->where(DB::raw('CHAR_LENGTH(src)'),">=", 8);
                        $query->where("src", "like", "____".$origem);
                    });

                    $query->orWhere(function($query) use ($origem){
                        $query->whereIn("type", ["sainte", "internas"]);
                        $query->where("accountcode", "=", $origem);
                    });
                });
            } 

            if(!empty($filtros['destino'])){
                $destino = preg_replace('/[^0-9]/', '', $filtros['destino']);

                $query->where(function($query) use ($destino){
                    $query->where("dst", $destino);
                    $query->orWhere("dst", "like", "0".$destino);
                    $query->orWhere("dst", "like", "__".$destino);
                    $query->orWhere(function($query) use ($destino){
                        $query->where(DB::raw('CHAR_LENGTH(dst)'),">", 8);
                        $query->where("dst", "like", "____".$destino);
                    });
                    
                    $query->orWhere(function($query) use ($destino){
                        $query->where("type", "entrante");
                        $query->where('peeraccount', "=", $destino);
                    });
                });         
            } 
        });


        if(!empty($filtros['data_min'])){
            $data_min_obj = \DateTime::createFromFormat("d/m/Y", $filtros['data_min']);
            $query->where(DB::raw('DATE(calldate)'), '>=', $data_min_obj->format("Y-m-d"));
        }

        if(!empty($filtros['data_max'])){
            $data_max_obj = \DateTime::createFromFormat("d/m/Y", $filtros['data_max']);
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
            $query->where('dst_type', '<>', "aplicacao");
        }

        return $query;
    }
}