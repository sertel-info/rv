<?php

namespace App\Http\Controllers\Admin\NotificacoesFlash;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Notificacoes\NotificacoesFlash;
use App\Models\Notificacoes\NotificacoesFlashUsers;
use App\Models\Assinantes\Assinantes;
use App\Http\Controllers\SessionController;
use App\Helpers\NotificationMessageCompiler\NotificationMessageCompiler;

class NotificacoesFlashController extends Controller
{   

    public function __construct(NotificacoesFlash $not){
        $this->entity = $not;
    }


    public function create(Request $request){
   		return view('rv.notificacoes_flash.create', ['assinante_md5_id'=>$request->a]);
    }

    public function store(Request $request){
        try{

            $assinante = Assinantes::whereRaw("MD5(id) = '".$request->a."'")->first();
            $notification = new NotificacoesFlash();
            $form_data = $this->getRequestData($request);
            $notification->fill($form_data);

            $msg_compiler = new NotificationMessageCompiler();
            $compiled_msg = $msg_compiler->compile($notification->mensagem, 
                                                    $assinante, 
                                                    $request);

                

            $notification_user = new NotificacoesFlashUsers();
            $notification_user->vista = false;
            $notification_user->user_id = $assinante->user->id;
            $notification_user->mensagem_compilada = $compiled_msg;
            
            if($notification->ativar_email !== null){
                $email_compiled_msg = $msg_compiler->compile($notification->email_corpo, 
                                                            $assinante, 
                                                            $request);

                $notification_user->mensagem_email_compilada = $email_compiled_msg;
            }


            DB::transaction(function() use ($notification, $notification_user){
                $notification->save();
                $notification_user->notificacao_flash_id = $notification->id;
                $notification_user->save();
            });

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.assinantes.manage');

        } catch (\Exception $ex){
            dd($ex);
            SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");
            return redirect()->back()->withInput();
        }
    }

    public function getRequestData(Request $request){

        $data = $request->only($this->entity->getFillable());

        if($request->ativar_email == null || $request->ativar_email == 0){
            $data['email_assunto'] = null;
            $data['email_corpo'] = null;
        }

        return $data;
    }

    public function markSeen(Request $request){
        $notification_usr = NotificacoesFlashUsers::where(DB::raw("md5(id)"), $request->n)->first();
        $notification_usr->vista = true;
        $notification_usr->save();

        return json_encode(['status'=>1]);
    }
}
