<?php

namespace App\Helpers\Extrato;
use App\Models\Cdr;
use DB;

class ExtratoFormatedQueryGetter {
	public static function get($linhas, $query = null){

		if($query == null){
			$query = \App\Models\Cdr::getQuery();
		}

		$destino_select = "CASE type".
                          " WHEN 'sainte' THEN dst".
                          " WHEN 'entrante' THEN IF(peeraccount <> dst, CONCAT(dst, ' <',peeraccount,'>'), dst )".
                          " WHEN 'internas' THEN dst".
                          " ELSE dst END ";
        
        $ligador_select = "CASE type ".
                          "WHEN 'sainte_siga_me' THEN siga_me_caller ".
                          "ELSE IF(type='sainte', accountcode, src) END ";


        $query = $query->select("*", DB::raw('SEC_TO_TIME(billsec) as billsec_time'),
                                        DB::raw($ligador_select." as origem"),
                                        DB::raw("DATE_FORMAT(DATE(calldate), \"%d/%m/%Y\") as date"),
                                        DB::raw("TIME_FORMAT(TIME(calldate), \"%H:%i:%s\") as time"),
                                        DB::raw("concat('R$ ', cost) as formated_cost"),
                                        DB::raw($destino_select." as destino"));

        $query->where('disposition', 'ANSWERED')
              	  ->orderBy('id', 'desc');

        $query->where(function($query) use ($linhas){
            $query->where(function($query) use ($linhas){
                $query->whereIn("accountcode", $linhas->pluck("autenticacao.login_ata")->toArray());
                $query->orWhereIn("peeraccount", $linhas->pluck("autenticacao.login_ata")->toArray());
            });

            $query->orWhere(function($query) use ($linhas){
                $query->where("type", "like", "%siga_me");
                $query->whereIn("src", $linhas->pluck("configuracoes.callerid"));
            });
        });
        

        return $query;


	}
}