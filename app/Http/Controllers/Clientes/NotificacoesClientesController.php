<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Models\Assinantes\Assinantes;
use App\Models\Notificacoes\NotificacoesUsers;
use App\Models\Notificacoes\NotificacoesFlashUsers;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class NotificacoesClientesController extends Controller
{   
 
  public function getMyNewNotifications(){

      $nao_vistas = $this->getNotificacoesCollection(false)->toArray();

      return json_encode(['status'=>1, 'notificacoes'=>$nao_vistas]);
  }

  public function markSeen(Request $request){
    $notification_usr = NotificacoesUsers::where(DB::raw("md5(id)"), $request->n)->first();
    $notification_usr->vista = true;
    $notification_usr->save();

    return json_encode(['status'=>1]);
  }

  public function viewAll(Request $request){
    $nao_vistas = $this->getNotificacoesCollection(false);

    return view("base.notifications.view_all", ['notificacoes'=>$nao_vistas]);
  }

  public function getNotificacoesCollection($vistas=false){
      $notificacoes_user = NotificacoesUsers::select(DB::raw("*, 0 as is_flash"))
                                ->where('user_id', Auth::user()->id)
                                ->with(['notificacao'=>function($query){
                                  $query->withIconName();
                                }])
                                ->withIdMd5()
                                ->withFormatedDate()
                                ->vista(false)
                                ->get();

      $notificacoes_flash_user = NotificacoesFlashUsers::select(DB::raw("*, 1 as is_flash"))
                                                    ->where('user_id', Auth::user()->id)
                                                    ->with(['notificacao'=>function($query){
                                                        $query->withIconName();
                                                    }])
                                                    ->withFormatedDate()
                                                    ->withIdMd5()
                                                    ->vista(false)
                                                    ->get();

      return $notificacoes_user->merge($notificacoes_flash_user);
                                      
  }

  public function getOld(Request $request){
      if(!$request->ajax()){
        abort(404);
      }

      $page = $request->page;
      return json_encode($this->getNotificacoesColletion(true)->forPage($page, 10)->toArray());
  }

  public function checkNew(Request $request){
    $has_new = NotificacoesUsers::where('user_id', Auth::user()->id)->vista(false)->count() > 0;
    $has_new_flash = NotificacoesFlashUsers::where('user_id', Auth::user()->id)->vista(false)->count() > 0;

    return json_encode(['status'=>1, 'has_new'=>$has_new || $has_new_flash]);
  }

}