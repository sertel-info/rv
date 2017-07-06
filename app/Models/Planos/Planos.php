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
							"descricao"
						   ];


	function assinantes(){
		return $this->hasMany("App\Models\Assinantes", "plano");
	} 

	public function scopeWithIdMd5($query){
    	if($query->getQuery()->columns == null){ 
    		$query->addSelect('*');
    	}
        $query->addSelect(\DB::Raw('MD5(planos.id) as id_md5'));
    }
}
