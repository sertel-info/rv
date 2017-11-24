<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Models\Assinantes\Assinantes;
use App\Models\Notificacoes\NotificacoesUsers;
use App\Models\Notificacoes\NotificacoesFlashUsers;
use App\Http\Controllers\Controller;
use JWTAuth;
use DB;

class NotificacoesController extends Controller
{   
  
  /*
  * Retorna as novas notificações do usuário
  */
  public function getNewNotifications(Request $request){
      try{
        $user = JWTAuth::toUser($request->cookie('token'));

        DB::statement("SET lc_time_names = 'pt_BR'");
        $notificacoes_user = NotificacoesUsers::select(DB::raw("*, 0 as is_flash"))
                                ->where('user_id', $user->id)
                                ->where('vista', false)
                                ->with(['notificacao'=>function($query){
                                  $query->withIconName();
                                }])
                                ->withFormatedDate()
                                ->orderBy('created_at', 'desc')
                                ->get();

        $notificacoes_flash_user = NotificacoesFlashUsers::select(DB::raw("*, 1 as is_flash"))
                                                    ->where('user_id', $user->id)
                                                    ->where('vista', false)
                                                    ->with(['notificacao'=>function($query){
                                                        $query->withIconName();
                                                    }])
                                                    ->withFormatedDate()
                                                    ->orderBy('created_at', 'desc')
                                                    ->get();

         $nao_vistas = $notificacoes_user->merge($notificacoes_flash_user)->toArray();

         return response()->json(['notfs'=>$nao_vistas]);
        
      } catch(\Exception $e){
         return response('', 500);
      }

  }

  public function markSeen(Request $request){
    $notification_usr = NotificacoesUsers::where(DB::raw("md5(id)"), $request->n)->first();
    $notification_usr->vista = true;
    $notification_usr->save();

    return json_encode(['status'=>1]);
  }


  public function getList(Request $request){
    try{
       $user = JWTAuth::toUser($request->cookie('token'));

       $notificacoes_user = NotificacoesUsers::select(DB::raw("*, 0 as is_flash"), 
                                                      DB::raw("DATE_FORMAT(created_at, '%H:%i:%s') as hora"))
                                  ->where('user_id', $user->id)
                                  ->with(['notificacao'=>function($query){
                                    $query->withIconName();
                                  }])
                                  ->withFormatedDate()
                                  ->orderBy('created_at', 'desc')
                                  ->get();

       $notificacoes_flash_user = NotificacoesFlashUsers::select(DB::raw("*, 1 as is_flash"),
                                                                 DB::raw("DATE_FORMAT(created_at, '%H:%i:%s') as hora"))
                                                      ->where('user_id', $user->id)
                                                      ->with(['notificacao'=>function($query){
                                                          $query->withIconName();
                                                      }])
                                                      ->withFormatedDate()
                                                      ->orderBy('created_at', 'desc')
                                                      ->get();

       $notificacoes = $notificacoes_user->merge($notificacoes_flash_user)->toArray();

       return response()->json(['notfs'=>$notificacoes]);
    
    } catch (\Exception $e){
       return response('', 500);
    }

  }

  public function mark(Request $request){
      if($request->is_flash === null)
        return response('', 500);

      try{
      
        if($request->is_flash == 0)
          $notf = NotificacoesUsers::find($request->notf);
        else 
          $notf = NotificacoesFlashUsers::find($request->notf);

        $notf->vista = true;
        $notf->save();

        return response('', 200);
      
      } catch (\Exception $e){
        
        return response('', 500);
      }
  }

}