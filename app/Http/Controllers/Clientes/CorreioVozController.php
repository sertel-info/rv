<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use JWTAuth;

class CorreioVozController extends Controller
{
    
    public function getGravacoesList(Request $request){
	    try{
	    	$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
	    	
	    	$voice_mail_path = config('asterisk.voice_mail_records');
			$files = array();

	    	if(!file_exists($voice_mail_path)){
	    		return response()->json(['data'=>[]], 200);
	    	}

	    	foreach($user->assinante->linhas as $line){
	    		$ramal = $line->autenticacao->login_ata;

	    		$inbox_path = $voice_mail_path . '/' . $user->assinante->id . '/' . $ramal;

	    		if(file_exists($inbox_path)){

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

	    	return response()->json(['data'=>$files], 200);
	    	
	    } catch (\Exception $e){
	    	return response('', 500);
	    }
    }

    public function downloadGravacao(Request $request){
    	$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
    	$file_name = 'msg' . $request->f . '.wav';
    	$ramal = $request->r;
    
    	/** Verifica se a linha pertence ao usuário**/
    	try{
	    	$line = $assinante->linhas->where("autenticacao.login_ata", $ramal)->first();
	    	if($line == null){
	    		return 0;
	    	} 

	    	$headers = array('Content-Type'=>'audio/mpeg');

	    	$full_file_path = config('asterisk.voice_mail_records'). '/' . $assinante->id . '/' . $ramal. '/' . $file_name;
	    	return response()->download($full_file_path, $file_name, $headers);
	    
	    } catch (\Exception $e){
	    	return response("", 500);
	    }
    }

    public function getBlob($ramal, $id){
    	$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
 		$gravacao = 'msg' . $id . '.wav';

    	if(!($user->assinante->linhas->where("autenticacao.login_ata", $ramal)->count())){
    		abort(403, 'Ação não autorizada');
    	}

    	$headers = array('Content-Type'=>'audio/x-wav');
    	
    	$file = config('asterisk.voice_mail_records') . '/' . $assinante->id . '/' . $ramal . '/'. $gravacao;
    	return response()->file($file, $headers);
    }
}
