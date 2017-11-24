<?php

namespace App\Models\Linhas;

use Illuminate\Database\Eloquent\Model;

class DadosFacilidadesLinhas extends Model
{
    protected $table = 'dados_facilidades_linhas';

    protected $fillable = [
							"perm_gravacao",
                            "perm_cadeado",
                            "perm_siga_me",
                            "perm_cx_postal",
                            "perm_at_automatico",
                            "gravacao",
							"cadeado_pessoal",
							"siga_me",
							"caixa_postal",
                            "cadeado_pin",
                            "pode_monitorar",
                            "monitoravel",
                            "num_siga_me",
                            "cx_postal_pw",
                            "cx_postal_email",
                            "saudacoes",
                            "saudacoes_destino",
                            "atend_automatico",
                            "atend_automatico_tipo",
                            "atend_automatico_destino"];

    public function linha(){
        return $this->belongsTo('App\Models\Linhas\Linhas', 'linha_id');
    }

    public function setGravacaoAttribute($value){
    	return $this->attributes['gravacao'] = (Boolean)$value;
    }

    public function setCadeadoPessoalAttribute($value){
    	return $this->attributes['cadeado_pessoal'] = (Boolean)$value;
    }

    public function setSigaMeAttribute($value){
    	return $this->attributes['siga_me'] = (Boolean)$value;
    }

    public function setCaixaPostalAttribute($value){
    	return $this->attributes['caixa_postal'] = (Boolean)$value;
    }

    public function setPinAttribute($value){
    	return $this->attributes['cadeado_pin'] = (Boolean)$value;
    }

    public function setMonitoravelAttribute($value){
        return $this->attributes['monitoravel'] = (Boolean)$value;
    }

    public function setPodeMonitorarAttribute($value){
        return $this->attributes['pode_monitorar'] = (Boolean)$value;
    }

    public function setAtendAutomaticoDestinoAttribute($value){
        if($value === "0" || !is_string($value) || strpos($value, "_") === FALSE)
            return $this->attributes = null;

        list($raw_tipo, $at_dest) = explode("_", $value);
        $at_tipo = null;

        switch($raw_tipo){
            case 'g':
                $at_tipo = 'grupo';
            break;
            case 'u':
                $at_tipo = 'ura';
            break; 
            case 'f':
                $at_tipo = 'fila';
            break;
        }

        $this->attributes['atend_automatico_destino'] = $at_dest;
        $this->attributes['atend_automatico_tipo'] = $at_tipo;
    }

    public function setAtendAutomaticoAttribute($value){
        return $this->attributes['atend_automatico'] = (Boolean)$value;
    }

    public function setSaudacoesAttribute($value){
        return $this->attributes['saudacoes'] = (Boolean)$value;
    }
}
