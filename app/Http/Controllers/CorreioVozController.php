<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class CorreioVozController extends Controller
{
    
    function __construct(){
    	
    }

    public function index(){
    	return view('rvc.correio_voz.index', ['active'=>'correio_voz',
    										'panel_title'=>'Caixa de Entrada']);
    }

    public function getGravacoesList(){
    	$user = $this->getUsuario();
    	//$lines = array();
    	$voice_mail_path = config('asterisk.voice_mail_records');
		$files = array();

    	if(file_exists($voice_mail_path)){

	    	foreach($user->assinante->linhas as $line){
	    		$ramal = $line->autenticacao->login_ata;

	    		$inbox_path = $voice_mail_path . '/' . $user->assinante->id . '/' . $ramal;

	    		if(file_exists($inbox_path)){
	    			/*$arquivos = glob('/var/spool/asterisk/voicemail/correio_de_voz/'.
	    							$ramal.'/INBOX/*.txt');*/

	    			$directory = new \RecursiveDirectoryIterator($inbox_path);
					$iterator = new \RecursiveIteratorIterator($directory);

					$iterator = new \RegexIterator($iterator, '/^.+\.txt$/i', \RecursiveRegexIterator::GET_MATCH);

					foreach(iterator_to_array($iterator) as $file){
						$file_name = basename($file[0]);
						$data = parse_ini_file($file[0]);
						$data['name'] = substr($file_name, 0, -4);
						$data['ramal'] = $ramal;
						$data['id'] = substr($data['name'], 3);
						
						$data['duration'] = sprintf('%02d:%02d:%02d', ($data['duration']/3600),
																	  ($data['duration']/60%60),
																	  $data['duration']%60);
 						
 						$data['origdate'] = \DateTime::createFromFormat('D M j h:i:s a e Y',
																		 $data['origdate'])
																		->format('d/m/Y h:i:s');
						array_push($files, $data);
					}
	    		}	    		
	    	}

	    	return json_encode(['data'=>$files]);
    	} else {
    		return json_encode(['data'=>[]]);
    	}
    }

    public function getUsuario(){
    	 return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
    	 											'assinante.linhas.configuracoes',
    	 											'assinante.linhas.autenticacao')
                                             ->first();
    }

    public function downloadGravacao(Request $request){
    	$user = $this->getUsuario(); 
    	$file_name = 'msg' . $request->f . '.wav';
    	$ramal = $request->r;
    
    	/** Verifica se a linha pertence ao usuário**/
    	try{
	    	$line = $user->assinante->linhas->where("autenticacao.login_ata", $ramal)->first();
	    	if($line == null){
	    		return 0;
	    	} 

	    	$headers = array('Content-Type'=>'audio/mpeg');

	    	$full_file_path = config('asterisk.voice_mail_records'). '/' . $user->assinante->id . '/' . $ramal. '/' . $file_name;
	    	return response()->download($full_file_path, $file_name, $headers);
	    
	    } catch (\Exception $e){
	    	dd($e);
	    	abort(403, 'Ação não autorizada');
	    }
    }


    public function getBlob($ramal, $id){
 		$user = $this->getUsuario();
 		$gravacao = 'msg' . $id . '.wav';

    	if(!($user->assinante->linhas->where("autenticacao.login_ata", $ramal)->count())){
    		abort(403, 'Ação não autorizada');
    	}

    	$headers = array('Content-Type'=>'audio/x-wav');
    	
    	$file = config('asterisk.voice_mail_records') . '/' . $user->assinante->id . '/' . $ramal . '/'. $gravacao;
    	return response()->file($file, $headers);
    }
}
