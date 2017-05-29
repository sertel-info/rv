<?php

namespace App\Models\Assinantes;

use Illuminate\Database\Eloquent\Model;

class DadosFacilidadesAssinante extends Model
{
    protected $table = "dados_facilidades_assinantes";

    protected $fillable = [
    					"assinante_id",
						"acesso_ramais",
						"portal_voz",
						"sala_conferencia",
						"fila_atendimento",
						"ura_atendimento",
						"envio_sms",
    					];


	public function assinante(){
		return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id');
	}

	public function setAcessoRamaisAttribute($value){
		$this->attributes['acesso_ramais'] = (Boolean)$value;
	}

	public function setPortalVozAttribute($value){
		$this->attributes['portal_voz'] = (Boolean)$value;
	}

	public function setSalaConferenciaAttribute($value){
		$this->attributes['sala_conferencia'] = (Boolean)$value;
	}

	public function setFilaAtendimentoAttribute($value){
		$this->attributes['fila_atendimento'] = (Boolean)$value;
	}

	public function setUraAtendimentoAttribute($value){
		$this->attributes['ura_atendimento'] = (Boolean)$value;
	}

	public function setEnvioSmsAttribute($value){
		$this->attributes['envio_sms'] = (Boolean)$value;
	}
}
