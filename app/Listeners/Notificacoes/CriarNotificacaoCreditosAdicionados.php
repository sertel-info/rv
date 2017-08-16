<?php

namespace App\Listeners\Notificacoes;

use App\Events\Creditos\CreditosAdicionados;
use App\Models\Notificacoes\Notificacoes;
use App\Models\Notificacoes\NotificacoesUsers;
use App\Helpers\NotificationMessageCompiler\NotificationMessageCompiler;
 
class CriarNotificacaoCreditosAdicionados {


    /**
     * Handle the event.
     *
     * @param  CreditosAdicionados  $event
     * @return void
     */
    public function handle(CreditosAdicionados $event)
    {
        
        $notifications = Notificacoes::where('escutar_evento', 'CreditosAdicionados')->get();

        foreach($notifications as $notification){
            $msg_compiler = new NotificationMessageCompiler();
            $compiled_msg = $msg_compiler->compile($notification->mensagem, 
                                                    $event->getAssinante(), 
                                                    $event->getRequest());

            $notification_user = new NotificacoesUsers();
            $notification_user->vista = false;
            $notification_user->notificacao_id = $notification->id;
            $notification_user->user_id = $event->getAssinante()->user->id;
            $notification_user->mensagem_compilada = $compiled_msg;

            if($notification->ativar_email !== null){
                $email_compiled_msg = $msg_compiler->compile($notification->email_corpo, 
                                                            $event->getAssinante(), 
                                                             $event->getRequest());

                $notification_user->mensagem_email_compilada = $email_compiled_msg;
            }

            $notification_user->save();
        }
    }
}
