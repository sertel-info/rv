<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//relacionamento entre linhas e grupos
class GruposLinhas extends Model
{
    
    protected $table = 'grupos_linhas';

    protected $fillable = ['linha_id', 'grupo_id', 'posicao'];

    public $timestamps = false;

    public function linhas(){
    	return $this->belongsTo('App\Models\Linhas', 'linha_id', 'id');
    }

    public function assinante(){
    	return $this->belongsTo('App\Models\GruposAtendimento\Assinantes', 'assinante_id', 'id');
    }

    
}
