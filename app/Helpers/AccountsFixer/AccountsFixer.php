<?php

namespace App\Helpers\AccountsFixer;

use App\Models\Cdr;
use App\Models\Linhas\Linhas;
use App\Models\Linhas\DadosAutenticacaoLinhas;
use App\Helpers\AGIClasses\Numero;

class AccountsFixer {

	public function exec(){
		$ligacoes = Cdr::all();

		foreach($ligacoes as $ligacao){
			try{

				if($ligacao->type == 'sainte'){

				$aut_linha = DadosAutenticacaoLinhas::where('login_ata', '=', $ligacao->accountcode)->first();

				if($aut_linha !== null){
					$linha = $aut_linha->linha;
				} else {
					continue;
				}

				$ligacao->src_id = $linha->id;
				$ligacao->save();

			
				} else if($ligacao->type == 'entrante'){

					$aut_linha = DadosAutenticacaoLinhas::where('login_ata', '=', $ligacao->peeraccount)->first();

					if($aut_linha !== null){
						$linha = $aut_linha->linha;
					} else {
						continue;
					}

					$ligacao->dst_id = $linha->id;

					$ligacao->save();

				} else if ($ligacao->type == 'internas' || $ligacao->type == 'interna') {

					$numero = new Numero($ligacao->dst);

					$ligacao->type = 'interna';

					$aut_ligador = DadosAutenticacaoLinhas::where('login_ata', '=', $ligacao->accountcode)->first();

					if($aut_ligador !== null){
						$ligador = $aut_ligador->linha;
					} else {
						continue;
					}

					$aut_receptor_ident = $ligacao->peeraccount == "" || $ligacao->peeraccount == null ? substr($ligacao->dst, 1) : $ligacao->peeraccount;

					$aut_receptor = DadosAutenticacaoLinhas::where('login_ata', '=', $aut_receptor_ident)->first();
										if($aut_receptor !== null){
						$receptor = $aut_receptor->linha;
					} else {
						continue;
					}

					$ligacao->dst_id = $receptor->id;
					$ligacao->src_id = $ligador->id;
					$ligacao->save();
				}
			
			} catch(\Exception $e){
				continue;

			}
			
		}
	}
}