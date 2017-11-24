<?php

namespace App\Models\Linhas;

use Illuminate\Database\Eloquent\Model;

class Dids extends Model
{
    protected $table = "dids";

    protected $fillable = ["usuario_did",
							"senha_did",
							"ip_did",
							"extensao_did",
							"linha_id",
							"status_did"];


	public function linha(){
		return $this->belongsTo('\App\Models\Linhas\Linhas', 'linha_id');
	}

	public function getStatusDidAttribute($value){
		return (Boolean)$value;
	}

	public function setUsuarioDidAttribute($value){
		$this->attributes['usuario_did'] = $value === null ? "" : $value;
	}

	public function setSenhaDidAttribute($value){
		$this->attributes['senha_did'] = $value === null ? "" : $value;
	}

	public function setIpDidAttribute($value){
		$this->attributes['ip_did'] = $value === null ? "" : $value;
	}

	public function setExtensaoDidAttribute($value){
		$this->attributes['extensao_did'] = $value === null ? "" : $value;
	}
}
