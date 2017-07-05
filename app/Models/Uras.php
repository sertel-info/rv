<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uras extends Model
{	
	protected $fillable = ['dig_tralha_tipo',
    					   'dig_asteristico_destino',
    					   'tipo_audio'];

    protected $table = 'uras';

    function __construct(){
        for($i = 1; $i < 10; $i++){
            array_push($this->fillable, "dig_".$i."_tipo", "dig_".$i."_destino");
        }
    }

    public function audio(){
    	return $this->belongsTo("App\Models\Audios", "audio_id", "id");
    }

    public function assinante(){
    	return $this->belongsTo("App\Models\Assinantes\Assinantes", "assinante_id", "id");
    }

    public function linha(){
        return $this->belongsTo("App\Models\Linhas\Linhas", "linha_id", "id");
    }

    public function scopeWithIdMd5($query){
        if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

        $query->addSelect(\DB::Raw('MD5(uras.id) as id_md5'));
    }

    public function setDig1DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_1_destino'] = $value;
    }

    public function setDig1TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_1_tipo'] = $value;
    }

    public function setDig2DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_2_destino'] = $value;
    }

    public function setDig2TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_2_tipo'] = $value;
    }

    public function setDig3DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_3_destino'] = $value;
    }

    public function setDig3TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_3_tipo'] = $value;
    }

    public function setDig4DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_4_destino'] = $value;
    }

    public function setDig4TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_4_tipo'] = $value;
    }

    public function setDig5DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_5_destino'] = $value;
    }

    public function setDig5TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_5_tipo'] = $value;
    }


    public function setDig6DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_6_destino'] = $value;
    }

    public function setDig6TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_6_tipo'] = $value;
    }

    public function setDig7DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_7_destino'] = $value;
    }

    public function setDig7TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_7_tipo'] = $value;
    }

    public function setDig8DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_8_destino'] = $value;
    }

    public function setDig8TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_8_tipo'] = $value;
    }

    public function setDig9DestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_9_destino'] = $value;
    }

    public function setDig9TipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_9_tipo'] = $value;
    }

    public function setDigTralhaDestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_tralha_destino'] = $value;
    }

    public function setDigTralhaTipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_tralha_tipo'] = $value;
    }

    public function setDigAsteristicoDestinoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_asteristico_destino'] = $value;
    }

    public function setDigAsteristicoTipoAttribute($value){
        if($value === "0"){
            $value = null;
        }

        $this->attributes['dig_asteristico_tipo'] = $value;
    }

}
