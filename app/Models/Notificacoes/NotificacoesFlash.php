<?php

namespace App\Models\Notificacoes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notificacoes\ScopesTraits\WithIconNameScopeTrait;
use App\Models\Notificacoes\ScopesTraits\VistasScopeTrait;
use App\Models\ScopesTraits\WithIdMd5ScopeTrait;

class NotificacoesFlash extends Model
{
	use WithIconNameScopeTrait;
	use VistasScopeTrait;
	use WithIdMd5ScopeTrait;

 	protected $table = "notificacoes_flash";

 	protected $fillable = ["mensagem",
							"titulo",
							"nivel",
							"email_assunto",
							"email_corpo",
							"ativar_email"];

	public function setAtivarEmailAttribute($value){
		$this->attributes['ativar_email'] = boolval($value);
	}
}
