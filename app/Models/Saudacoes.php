<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saudacoes extends Model
{
    protected $table = "saudacoes";
    protected $fillable = ["nome",
							"tipo_audio",
							"audio_id",
							"ativo",
							"assinante_id"];

	public function audio(){
		return $this->belongsTo('App\Models\Audios', 'audio_id', 'id');
	}

	public function assinante(){
		return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id', 'id');
	}

	public function scopeWithIdMd5($query){
        if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

        $query->addSelect(\DB::Raw('MD5(saudacoes.id) as id_md5'));
    }

    public function setAtivoAttribute($value){
    	$this->attributes['ativo'] = (Boolean)$value;
    }
}
