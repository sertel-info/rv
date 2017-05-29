<?php

namespace App\Models\Linhas;

use Illuminate\Database\Eloquent\Model;

class DadosConfiguracoesLinhas extends Model
{
    protected $table = "dados_configuracoes_linhas";

    protected $fillable = [
							"callerid",
							"envio_dtmf",
							"ring_falso",
							"nat",
                            "linha_id",
                            "pickup_group",
                            "call_group",
                            "rotas_saida"
    					  ];
    
    public function linha(){
        return $this->belongsTo('App\Models\Linhas\Linhas', 'linha_id');
    }

    public function setRingFalsoAttribute($value){
    	return $this->attributes['ring_falso'] = (Boolean)$value;
    }


    public function setNatAttribute($value){
    	return $this->attributes['nat'] = (Boolean)$value;
    }

    public function setRotasSaidaAttribute($value){
        if(is_array($value) || is_object($value)){
           return $this->attributes['rotas_saida'] = json_encode($value);
        }

        return $this->attributes['rotas_saida'] = $value; 
    }

    public function getRotasSaidaAttribute($value){
        if($value == null){
            return [];
        }

        return json_decode($value);
    }
}
