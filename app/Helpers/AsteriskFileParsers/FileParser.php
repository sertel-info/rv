<?php

namespace App\Helpers\AsteriskFileParsers;

use App\Helpers\Contracts\AsteriskConfigFileParserContract;

class FileParser {

	private $file;
    private $commands = array();
    private $commit_history = array();

    /*private $buffers = array(
                        "registry"=>array(),
                        "extension"=>array(),
                        "sip_ramal"=>array(),
                        "voice_mail"=>array(),
                        "app_ura"=>array()
                       );*/

	public function setFile($file){
		$this->file = $file;
	}

    public function getFileContent(){
        if(!$this->file || !file_exists($this->file)){
            return [];
        }

		return file($this->file,  FILE_IGNORE_NEW_LINES);
	}

	public function getSession($arquivo, $session){
		$inicio = -1;
		$fim = -1;
		$tamanho_arquivo = count($arquivo);
		
		foreach($arquivo as $pos=>$linha){
    		if(preg_match('/\['.$session.'\]/i', $linha)){
    			$inicio = $pos;
    			break;
    		}
    	}

    	if($inicio < 0){
    		return false; 
    	}

		for($i = $inicio+1; $i<$tamanho_arquivo; $i++){
    		if(preg_match('/\[(.*?)\]/', $arquivo[$i])){
    			$fim = $i;
    			break;    			
    		}
    	}

   		if($fim < 0){
   			$fim = count($arquivo);
   		}

    	return [
    			'conteudo'=>array_slice($arquivo, $inicio, $fim-$inicio),
    			'tamanho'=>$fim-$inicio,
                'inicio'=>$inicio
    			];
	}


    public function commit(){
        
        foreach($this->commands as $command){
            if($command['command'] == 'write'){
                $handle = fopen($command['file'], "w");

                if(fwrite($handle, implode("\n", $command['content'])) === FALSE){
                    return 0;
                }

                fclose($handle);
            }
        }

        return 1;
    }

    public function addRegistry($user, $password, $ip, $login_ata){
        array_push($this->buffers['registry'], 'register=>'.$user.':'.$password.'@'.$ip.'/'.$login_ata);
    }

    public function addExtension($exten, $prioridade, $app, $contexto){
        if(!$this->sessionExists($contexto, 'extension')){
            $this->addSession($contexto, 'extension');
            array_push($this->buffers['extension'], 'exten=>'.$exten.','.$prioridade.','.$app);
        } else {
            $session = $this->getSession($this->buffers['extension'], $contexto);
            array_push($session['conteudo'], 'exten=>'.$exten.','.$prioridade.','.$app);
            array_splice($this->buffers['extension'], $session['inicio'], $session['tamanho'], $session['conteudo']);
        }
    }

    public function addExtensionUra($exten, $prioridade, $app, $contexto){
        if(!$this->sessionExists($contexto, 'app_ura')){
            $this->addSession($contexto, 'app_ura');
            array_push($this->buffers['app_ura'], 'exten=>'.$exten.','.$prioridade.','.$app);
        } else {
            $session = $this->getSession($this->buffers['app_ura'], $contexto);
            array_push($session['conteudo'], 'exten=>'.$exten.','.$prioridade.','.$app);
            array_splice($this->buffers['app_ura'], $session['inicio'], $session['tamanho'], $session['conteudo']);
        }
    }
    
    public function addSession($session_name, $buffer){
        array_push($this->buffers[$buffer], "\n[".$session_name.']');
    }

    public function addVoiceMail($voice_mail, $contexto){
        if(!$this->sessionExists($contexto, 'voice_mail')){
            $this->addSession($contexto, 'voice_mail');
            array_push($this->buffers['voice_mail'], $voice_mail);
        
        } else {

            $session = $this->getSession($this->buffers['voice_mail'], $contexto);
            
            array_push($session['conteudo'], $voice_mail);
            array_splice($this->buffers['voice_mail'],
                                     $session['inicio'], 
                                     $session['tamanho'], 
                                     $session['conteudo']);

        }

    }

    public function sessionExists($session, $buffer){
        $text = $this->buffers[$buffer];

        if(!$text){
            return 0;
        }

        foreach($text as $pos=>$linha){
            if(preg_match('/\['.$session.'\]/i', $linha)){
                return 1;
            }
        }

        return 0;
    }

    public function addSipRamal($ramal, $key_values){
        
        $this->addSession($ramal, 'sip_ramal');

        foreach($key_values as $key=>$value){
            if($key == 'codecs' && is_array($value)){
                foreach($value as $codec){
                    array_push($this->buffers['sip_ramal'], "allow"."=".$codec);
                }
            }
            else {
                array_push($this->buffers['sip_ramal'], $key."=".$value);
            }
        }
    }

    public function write($buffer){

        array_push($this->commands, ['command'=>'write',    
                                        'content'=>$this->buffers[$buffer],
                                        'rollback_info'=>$this->getFileContent(),
                                        'file'=>$this->file]);
    }

    public function addBuffer($buffer_name){
        $this->buffers[$buffer_name] = array();
    }


    public function rollback(){
        //
    }

    public function writeInclude($file){
        return "#include=>".$file;
    }
    
}