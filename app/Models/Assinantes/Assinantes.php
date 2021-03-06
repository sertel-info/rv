<?php

namespace App\Models\Assinantes;

use Illuminate\Database\Eloquent\Model;

class Assinantes extends Model
{
    protected $table = "assinantes";

    protected $fillable = ["plano",
                           "nome_fantasia",
                           "nome",
    					   "sobrenome",
    					   "razao_social",
    					   "cnpj",
    					   "cpf",
    					   "inscricao_estadual",
    					   "rg",
    					   "tipo"];

    /*
    *
    * Relacionamentos
    */
    public function planos(){
        return $this->belongsTo("App\Models\Planos\Planos", "plano", "id");
    }

    public function linhas(){
        return $this->hasMany('App\Models\Linhas\Linhas', 'assinante_id', 'id');
    }

    public function contato(){
        return $this->hasOne('App\Models\Assinantes\DadosContatoAssinante', 'assinante_id', 'id');
    }

    public function financeiro(){
        return $this->hasOne('App\Models\Assinantes\DadosFinanceiroAssinante', 'assinante_id', 'id');
    }

    public function facilidades(){
        return $this->hasOne('App\Models\Assinantes\DadosFacilidadesAssinante', 'assinante_id', 'id');
    }

    public function acesso(){
        return $this->hasOne('App\User', 'assinante_id', 'id');
    }

    /*
    * Mutators
    */
    public function setTipoAttribute($value){
        $this->attributes['tipo'] = (Boolean)$value;
    }

    public function setCreditosAttribute($value){
        $this->attributes['creditos'] = floatval($value);
    }

    public function atualizacoesCreditos(){
        return $this->hasMany("App\Models\AtualizacoesCreditos", "assinante_id", 'id');
    }
    
}
