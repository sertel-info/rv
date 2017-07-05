<?php

namespace App\Helpers\BillFixer;

use App\Http\Controllers\Controller;
use App\Models\Cdr;
use App\Models\Linhas\DadosAutenticacaoLinhas;
use App\Models\Linhas\DadosConfiguracoesLinhas;
use App\Helpers\BillFixer\BillCalculator;
use App\Helpers\BillFixer\Numero;

class BillFixer extends Controller {

	public function verificarDebitos(){
		$linhas = Cdr::where("type", "sainte")
					->where("disposition", "ANSWERED")
					->where("cost", "=", 0.00)
					->where("billsec", ">", 3)
					->get()
					->groupBy('src');

		$totais = array();
		
		foreach($linhas as $src=>$ligacoes){
			
			
			if(!isset($totais[$src])){
				$totais[$src] = 0;
			}

			$dados_linha = DadosAutenticacaoLinhas::where("login_ata", $src)->first();
			
			if($dados_linha == null){
				$dados_linha = DadosConfiguracoesLinhas::where('callerid', $src)->first();
			}

			try{
				$linha = $dados_linha->linha;
				$assinante = $linha->assinante()->with('planos')->first();
			} catch (\Exception $e){
				continue;
			}
			
			foreach($ligacoes as $ligacao){
				$numero = new Numero($ligacao->dst);
				$tarifa = $assinante->planos->__get('valor_'.$numero->getTipo().'_'.($numero->isDDD() ? 'ddd' : 'local'));

				$custo = BillCalculator::calcTarifa($numero->getTipo(), $tarifa, $ligacao->billsec);
				
				$ligacao->cost = $custo;
				$ligacao->save();

				$assinante->financeiro->decrement('creditos', $custo);
			}
		}
	
	}
}