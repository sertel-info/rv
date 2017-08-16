<?php
require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/Connections.php";
require_once __DIR__."/MailSender.php";
require_once __DIR__."/NotificationsModelsGetter.php";

use App\Models\Notificacoes\EnviosEmailsNotificacoes;
use App\Models\Notificacoes\EnviosEmailsNotificacoesFlash;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

define("MAIL_FROM", "comercial@sertel-info.com.br");
define("MAX_RETRIES", 3);

$logger = new Logger('daemon');
$logger->pushHandler(new StreamHandler(__DIR__."/logs/log.log"), Logger::WARNING);
$logger->info("Iniciando Daemon...");

$sender = new MailSender();
$sender->setFrom(MAIL_FROM);

while(true){
	$novas_notificacoes = NotificationsModelsGetter::getNew();

	if($novas_notificacoes == null){
		$logger->info("Notificação Inválida Encontrada");
		continue;
	}

	foreach($novas_notificacoes as $notificacao_user){
		try{
			$email_to = $notificacao_user->user->assinante->contato->email;
			if( $email_to !== null){
				$logger->info("Enviando email");
				$logger->debug("Email para : ".$email_to);

				$sender->setTo("eduardo.junior.contato@hotmail.com");
				$sender->setBody($notificacao_user->mensagem_email_compilada);
				$logger->debug("Corpo do email: ", [$notificacao_user->mensagem_email_compilada]);
				
				$sender->setSubject($notificacao_user->notificacao->email_assunto);
				$logger->debug("Assunto do email: ", [$notificacao_user->mensagem_email_compilada]);
		
				$try = 1;

				do {
					$logger->debug("Tentativa : ".$try);
					$response = $sender->send();
					$logger->debug("Reponse : ", (Array)$response);
					$try++;

				} while($try <= MAX_RETRIES && $response->status !== 1);

				if($response->status !== 1){
					$logger->errror("Erro recebido na response ", [$response->err_msg]);
					//echo "erro : ".var_export($response->err_msg, true)."\r\n";
				} else {
					$logger->info("Email enviado com sucesso...");
				}

				if($notificacao_user->is_flash == 0){
					$logger->debug("A Notificação não é Flash ");
					$logger->debug("Criando registro email_notificacoes ");

					$envio = EnviosEmailsNotificacoes::create(['status'=>$response->status,
																		   'notificacoes_users_id'=>$notificacao_user->notf_users_id,
																		   ]);
				} else {

					$logger->debug("A Notificação é Flash ");
					$logger->debug("Criando registro email_notificacoes ");

					$envio = EnviosEmailsNotificacoesFlash::create(['status'=>$response->status,
																			   'notif_flash_users_id'=>$notificacao_user->notf_users_id,
																			   ]);
				}	

			} 
			sleep(1);		
		} catch (\Exception $e){
			$logger->warning("Exceção capturada ! ", $e->__toString());
		}
					
	}

	sleep(2);
}
