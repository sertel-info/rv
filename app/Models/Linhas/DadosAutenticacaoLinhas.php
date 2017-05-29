<?php

namespace App\Models\Linhas;

use Illuminate\Database\Eloquent\Model;

class DadosAutenticacaoLinhas extends Model
{
	protected $table = "dados_autenticacao_linhas";
	
    protected $fillable = ['login_ata',
    					   'usuario',
    					   'senha',
    					   'ip',
    					   'porta',
                           'linha_id'
    					   ];
    
    public function linha(){
        return $this->belongsTo('App\Models\Linhas\Linhas', 'linha_id');
    }
}
