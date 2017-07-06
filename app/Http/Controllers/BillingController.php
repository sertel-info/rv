<?php


use Illuminate\Http\Request;
use App\Models\Cdr;
use App\Models\Cel;
use App\User;
use App\Http\Controllers\Controller;
use Auth;

class BillingController extends Controller
{
    
    public function getContas(Request $request){
		$logged_user = Auth::user();
		
		if($request->u && $logged_user->role == 0){
			$user_id = $request->u;
		} else {
			$user_id = $logged_user->id;
		}

		$user = $this->getUsuario($user_id);
    }

    public function getUsuario(){
    	 return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
    	 											'assinante.linhas.configuracoes',
    	 											'assinante.linhas.autenticacao')
                                             ->first();
    }

}
;