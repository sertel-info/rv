<?php

namespace App\Models\Linhas;

use Illuminate\Database\Eloquent\Model;

class Linhas extends Model
{
    protected $table = "linhas";

    protected $fillable = ["assinante_id",
							"tecnologia",
							"ddd_local",
							"nome",
							"simultaneas",
							"funcionalidade",
							"status_did",
							"codecs",
							"cli"
	];

	public function setStatusDidAttribute($value){
		$this->attributes['status_did'] = (Boolean)$value;
	}

	public function setCodecsAttribute($value){
		$this->attributes['codecs'] = in_array(gettype($value), ['array', 'object']) ?
																	 json_encode($value) : "[]";
	}

	public function getCodecsAttribute($value){
		if($value == null){
			return [];
		}

		return json_decode($value);
	}

	public function setCliAttribute($value){
		$this->attributes['cli'] = (Boolean)$value;
	}

	public function assinante(){
		return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id' , 'id');
	}
 	
 	public function autenticacao(){
 		return $this->hasOne('App\Models\Linhas\DadosAutenticacaoLinhas', 'linha_id', 'id');
 	} 

 	public function configuracoes(){
 		return $this->hasOne('App\Models\Linhas\DadosConfiguracoesLinhas', 'linha_id', 'id');
 	} 

 	public function facilidades(){
 		return $this->hasOne('App\Models\Linhas\DadosFacilidadesLinhas', 'linha_id', 'id');
 	} 

 	public function permissoes(){
 		return $this->hasOne('App\Models\Linhas\DadosPermissoesLinhas', 'linha_id', 'id');
 	} 

 	public function did(){
 		return $this->hasOne('App\Models\Linhas\Dids', 'linha_id', 'id');
 	}  	

}
