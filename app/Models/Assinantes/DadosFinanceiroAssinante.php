<?php

namespace App\Models\Assinantes;

use Illuminate\Database\Eloquent\Model;

class DadosFinanceiroAssinante extends Model
{
    protected $table = "dados_financeiro_assinantes";

    protected $fillable = ["assinante_id",
							"dias_bloqueio",
							"dia_vencimento",
							"espaco_disco",
							"alerta_saldo",
							"creditos"
						  ];

	public function assinante(){
		return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id', 'id');
	}


    public function setAlertaSaldoAttribute($value){
        $value = preg_replace("/[\.]/", "", $value);
        $value = preg_replace("/[\,]/", ".", $value);

        $this->attributes['alerta_saldo'] = floatval($value);
    }

    public function setEspacoDiscoAttribute($value){
    	$value = preg_replace("/[^0-9\\.]/", '', $value);
		$this->attributes['espaco_disco'] = floatval($value);
    }
    
}
