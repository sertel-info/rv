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
use App\Http\Requests\Validators\Assinantes\NotificacoesFlashRequest;

class NotificacoesFlashController extends Controller
{   

    public function __construct(NotificacoesFlash $not){
        $this->entity = $not;
    }

    public function store(NotificacoesFlashRequest $request){
        try{

            $assinante = Assinantes::find($request->a);
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

            DB::beginTransaction();
                $notification->save();
                $notification_user->notificacao_flash_id = $notification->id;
                $notification_user->save();
            DB::commit();

            return response('', 200);

        } catch (\Exception $ex){
            DB::rollback();
            dd($ex);
            return response('', 200);
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
