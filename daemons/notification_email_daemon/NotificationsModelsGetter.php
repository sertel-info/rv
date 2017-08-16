<?php

use App\Models\Notificacoes\NotificacoesUsers;
use App\Models\Notificacoes\NotificacoesFlashUsers;

class NotificationsModelsGetter{

	public static function getNew(){

		$notificacoes_users =NotificacoesUsers::selectRaw('*, 0 as is_flash')
									->withCount("envios")
									->with("user.assinante.contato")
									->addSelect("notificacoes.id as notf_user")
								    ->addSelect("notificacoes_users.id as notf_users_id")
									->leftjoin("notificacoes",
												 "notificacoes.id",
												 "=",
												 "notificacoes_users.notificacao_id")
									->where("notificacoes.ativar_email", 1)
									->get()
									->where("envios_count", 0);


		$notificacoes_flash = NotificacoesFlashUsers::selectRaw('*, 1 as is_flash')
									->withCount("envios")
									->with("user.assinante.contato")
									->addSelect("notificacoes_flash.id as notf_user")
								    ->addSelect("notificacoes_flash_users.id as notf_users_id")
									->leftjoin("notificacoes_flash",
												 "notificacoes_flash.id",
												 "=",
												 "notificacoes_flash_users.notificacao_flash_id")
									->where("notificacoes_flash.ativar_email", 1)
									->get()
									->where("envios_count", 0);
		
		/* Faz um "merge" manual pois o da classe estava realizando substituições */
		foreach($notificacoes_flash as $nt_flash){
			$notificacoes_users->push($nt_flash);
		}

		return $notificacoes_users;

	}
}