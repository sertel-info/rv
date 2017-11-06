<?php

namespace App\Models\Planos;

use Illuminate\Database\Eloquent\Model;

class Planos extends Model
{
    protected $table = "planos";

    protected $fillable = ["nome",
    						"tipo",
							"valor_sms",
							"valor_fixo_local",
							"valor_fixo_ddd",
							"valor_movel_local",
							"valor_movel_ddd",
							"valor_ddi",
							"valor_ip",
							"valor_movel_entrante",
							"valor_fixo_entrante",
							"descricao",
						   ];


	public function assinantes(){
		return $this->hasMany("App\Models\Assinantes", "plano");
	} 


	public function scopeWithIdMd5($query){
    	if($query->getQuery()->columns == null){ 
    		$query->addSelect('*');
    	}
        $query->addSelect(\DB::Raw('MD5(planos.id) as id_md5'));
    }

    public function getDescricaoAttribute($value){
    	return $value == null ? "" : $value;
    }

    public function setValorSmsAttribute($value){
    	$this->attributes['valor_sms'] = floatval($value);
    }

     public function setValorFixoLocalAttribute($value){
    	$this->attributes['valor_fixo_local'] = floatval($value);
    }

    public function setValorFixoDddAttribute($value){
    	$this->attributes['valor_fixo_ddd'] = floatval($value);
    }

    public function setValorMovelLocalAttribute($value){
    	$this->attributes['valor_movel_local'] = floatval($value);
    }

    public function setValorMovelDddAttribute($value){
    	$this->attributes['valor_movel_ddd'] = floatval($value);
    }

    public function setValorDdiAttribute($value){
    	$this->attributes['valor_ddi'] = floatval($value);
    }

    public function setValorIpAttribute($value){
    	$this->attributes['valor_ip'] = floatval($value);
    }

    public function setValorMovelEntranteAttribute($value){
    	$this->attributes['valor_movel_entrante'] = floatval($value);
    }

    public function setValorFixoEntranteAttribute($value){
    	$this->attributes['valor_fixo_entrante'] = floatval($value);
    }
}
