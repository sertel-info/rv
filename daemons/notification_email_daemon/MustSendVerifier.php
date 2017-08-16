<?php

class MustSendVerifier{

	private $notificacao_user;
	
	public function verify($notificacao_user){
		$this->notificacao_user = $notificacao_user;

		return $this->emailActivated();
	}


	public function emailActivated(){
		return $this->notificacao_user->notificacao->ativar_email == 1;
	}

}