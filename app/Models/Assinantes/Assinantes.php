<?php

namespace App\Models\Assinantes;

use Illuminate\Database\Eloquent\Model;
use App\Models\ScopesTraits\WithIdMd5ScopeTrait;

class Assinantes extends Model
{   
    use WithIdMd5ScopeTrait;

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

    public function user(){
        return $this->hasOne('App\User', 'assinante_id', 'id');
    }

    public function saudacoes(){
        return $this->hasMany('App\Models\Saudacoes', 'assinante_id', 'id');
    }

    public function audios(){
        return $this->hasMany('App\Models\Audios', 'assinante_id', 'id');
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
    
    public function grupos(){
        return $this->hasMany("App\Models\GruposAtendimento", "assinante_id", "id");
    }


    public function ura(){
        return $this->hasOne("App\Models\Uras", "assinante_id", "id");
    }

    public function filas(){
        return $this->hasMany("App\Models\Filas", "assinante_id", "id");
    }

    public function atualizacoesCreditos(){
        return $this->hasMany("App\Models\AtualizacaoCreditos", "assinante_id", "id");
    }

    public function getInscricaoEstadualAttribute($value){
        return $value == null ? "" : $value;
    }
}
