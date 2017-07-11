<?php

namespace App\Helpers\TypeFixer;

use App\Models\Cdr;

class TypeFixer {

	public function exec(){
		$ligacoes = Cdr::where("type", "")->get();

		foreach($ligacoes as $ligacao){
			try{
			
				if($ligacao->dst_type == "fixo" || $ligacao->dst_type == "movel"){
					
					if(!empty($ligacao->peeraccount) && empty($ligacao->accountcode)){
						
						$ligacao->type = "entrante";
						$ligacao->dst_type = "interno";

					} else if(!empty($ligacao->accountcode) && empty($ligacao->peeraccount)){

						$ligacao->type = "sainte";

					}
				
				} 

				$ligacao->save();
			
			} catch (\Exception $e){
				dd($e);
				continue;

			}
		}
	}

}