<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uras extends Model
{	
	protected $fillable = ['nome',
    					   'tipo_audio',
                           'dig_0_tipo',
                           'dig_0_destino',
                           'dig_1_tipo',
                           'dig_1_destino',
                           'dig_2_tipo',
                           'dig_2_destino',
                           'dig_3_tipo',
                           'dig_3_destino',
                           'dig_4_tipo',
                           'dig_4_destino',
                           'dig_5_tipo',
                           'dig_5_destino',
                           'dig_6_tipo',
                           'dig_6_destino',
                           'dig_7_tipo',
                           'dig_7_destino',
                           'dig_8_tipo',
                           'dig_8_destino',
                           'dig_9_tipo',
                           'dig_9_destino',
                           'dig_asteristico_tipo',
                           'dig_asteristico_destino',
                           'dig_tralha_tipo',
                           'dig_tralha_destino',
                           'assinante_id'];

    protected $table = 'uras';

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

    /*
    *  Recebe um parametro do tipo "r_12"
    *  e retorna um array associativo com 
    *  os atributos 'destino' e 'tipo';
    */
    public function getTipoAndDestino($destino){
        if($destino === "0")
            return ["destino"=>null,
                    "tipo"=>null];

                    
        $dest_arr = explode("_", $destino);
        $tipo = null;
        $destino = $dest_arr[1];

        switch($dest_arr[0]){
            case 'r' :
                $tipo = "ramal";
            break;
            case 'g' : 
                $tipo ="grupo";
            break;
            case 'f' :
                $tipo = "fila";
            break;
        }

        return ["destino"=>$destino,
                "tipo"=>$tipo];
    }


    public function setDig0DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_0_tipo'] = $params["tipo"];
        $this->attributes['dig_0_destino'] = $params["destino"];
    }

    public function setDig1DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_1_tipo'] = $params["tipo"];
        $this->attributes['dig_1_destino'] = $params["destino"];
    }

    public function setDig2DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_2_tipo'] = $params["tipo"];
        $this->attributes['dig_2_destino'] = $params["destino"];
    }

    public function setDig3DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_3_tipo'] = $params["tipo"];
        $this->attributes['dig_3_destino'] = $params["destino"];
    }

    public function setDig4DestinoAttribute($value){
       $params = $this->getTipoAndDestino($value);
       $this->attributes['dig_4_tipo'] = $params["tipo"];
       $this->attributes['dig_4_destino'] = $params["destino"];
    }

    public function setDig5DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_5_tipo'] = $params["tipo"];
        $this->attributes['dig_5_destino'] = $params["destino"];
    }

    public function setDig6DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_6_tipo'] = $params["tipo"];
        $this->attributes['dig_6_destino'] = $params["destino"];
    }

    public function setDig7DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_7_tipo'] = $params["tipo"];
        $this->attributes['dig_7_destino'] = $params["destino"];
    }

    public function setDig8DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_8_tipo'] = $params["tipo"];
        $this->attributes['dig_8_destino'] = $params["destino"];
    }

    public function setDig9DestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_9_tipo'] = $params["tipo"];
        $this->attributes['dig_9_destino'] = $params["destino"];
    }

    public function setDigTralhaDestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_tralha_tipo'] = $params["tipo"];
        $this->attributes['dig_tralha_destino'] = $params["destino"];
    }

    public function setDigAsteristicoDestinoAttribute($value){
        $params = $this->getTipoAndDestino($value);
        $this->attributes['dig_asteristico_tipo'] = $params["tipo"];
        $this->attributes['dig_asteristico_destino'] = $params["destino"];
    }
}
