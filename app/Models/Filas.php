<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filas extends Model
{
    protected $table = 'filas';
    protected $fillable = ["nome",
							"tipo",
							"tempo_chamada",
							"regra_transbordo"];


	public function linhas(){
		return $this->belongsToMany("App\Models\Linhas\Linhas", 'linhas_filas', 'fila_id', 'linha_id')->withPivot('posicao');
	}

	public function assinante(){
		return $this->belongsTo("App\Models\Assinantes\Assinantes", "assinante_id", "id");
	}

	public function scopeWithIdMd5($query){
        if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

        $query->addSelect(\DB::Raw('MD5(filas.id) as id_md5'));
    }

    public function setNomeAttribute($value){
    	$this->attributes['nome'] = preg_replace("/[^a-zA-Z0-9s]+/", "", $value);
    }

    public function setRegraTransbordoAttribute($value){
    	$this->attributes['regra_transbordo'] = (Boolean)$value;
    }
}
