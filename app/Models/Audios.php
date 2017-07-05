<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audios extends Model
{
    protected $table = 'audios';

    protected $fillable = ["nome_original",
							"nome",
							"caminho",
							"extensao",
							];


	public function ura(){
		return $this->hasOne('App\Models\Uras', 'audio_id', 'id');
	}

	public function saudacao(){
		return $this->hasOne("App\Models\Audios", 'audio_id', 'id');
	}

	public function assinante(){
		return $this->hasOne("App\Models\Assinantes\Assinantes", 'assinante_id', 'id');
	}
}
