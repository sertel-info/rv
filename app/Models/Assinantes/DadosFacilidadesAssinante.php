<?php

namespace App\Models\Assinantes;

use Illuminate\Database\Eloquent\Model;

class DadosFacilidadesAssinante extends Model
{
    protected $table = "dados_facilidades_assinantes";

    protected $fillable = [
    					"correio_voz",
						"grupos_atendimento",
						"fila",
						"ura",
						"gravacoes",
						"saudacoes",
						"acesso_extrato",
						"acesso_cx_postal",
						"acesso_siga_me",
						"acesso_at_automatico",
						"acesso_cadeado"
    					];


	public function assinante(){
		return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id');
	}

	public function setCorreioVozAttribute($value){
		$this->attributes['correio_voz'] = (Boolean)$value;
	}

	public function setGruposAtendimentoAttribute($value){
		$this->attributes['grupos_atendimento'] = (Boolean)$value;
	}

	public function setFilaAttribute($value){
		$this->attributes['fila'] = (Boolean)$value;
	}

	public function setUraAttribute($value){
		$this->attributes['ura'] = (Boolean)$value;
	}

	public function setGravacoesAttribute($value){
		$this->attributes['gravacoes'] = (Boolean)$value;
	}

	public function setAcessoExtratoAttribute($value){
		$this->attributes['acesso_extrato'] = (Boolean)$value;
	}

	public function setSaudacoesAttribute($value){
		$this->attributes['saudacoes'] = (Boolean)$value;
	}
}
