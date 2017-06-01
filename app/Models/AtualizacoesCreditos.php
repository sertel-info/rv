<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtualizacoesCreditos extends Model
{
    protected $table = 'atualizacoes_creditos';

    protected $fillable = ['value', 'user_id'];

    public function assinantes(){
    	return $this->hasOne("App\Models\Assinantes", "assinante_id", "id");
    }
}
