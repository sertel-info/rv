<?php

namespace App\Models\Notificacoes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notificacoes\ScopesTraits\WithIconNameScopeTrait;
use App\Models\Notificacoes\ScopesTraits\VistasScopeTrait;
use App\Models\ScopesTraits\WithIdMd5ScopeTrait;

class Notificacoes extends Model
{
	use WithIconNameScopeTrait;
	use VistasScopeTrait;
	use WithIdMd5ScopeTrait;

    protected $table = "notificacoes";
    
    protected $fillable  = ['mensagem',
							'titulo',
							'nome',
							'nivel',
							'escutar_evento',
							'ativar_email',
							'email_assunto',
							'status',
							'email_corpo'];

	public function user(){
		return $this->belongsTo("App\Models\Notifications", "user_id", "id");
	}

	public function setAtivarEmailAttribute($value){
		$this->attributes['ativar_email'] = boolval($value);
	}

	public function getAtivarEmailAttribute($value){
		return boolval($value);
	}

	public function setStatusAttribute($value){
		$this->attributes['status'] = boolval($value);
	}

	public function getStatusAttribute($value){
		return boolval($value);
	}

}
