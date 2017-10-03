<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AtualizacaoCreditos extends Model {
	protected $table = "atualizacoes_creditos";
	protected $guarded = [	"assinante_id",
							"value",
							"created_at",
							"valor_anterior", 
							"updated_at"];


	public function setValueAttribute($value){
		$this->attributes['value'] = floatval($value);
	}

	public function setValorAnteriorAttribute($value){
		$this->attributes['valor_anterior'] = floatval($value);
	}
}