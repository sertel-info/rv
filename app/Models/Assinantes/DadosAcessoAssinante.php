<?php

namespace App\Models\Assinantes;

use Illuminate\Database\Eloquent\Model;

class DadosAcessoAssinante extends Model
{
    protected $table = "dados_acesso_assinantes";

    protected $fillable = ["assinante_id",
    					   "nome",
    					   "senha",
    					   "email",
    					  ];

    public function assinante(){
		return $this->belongsTo('App\Models\Assinantes\Assinantes', 'assinante_id');
	}
}
