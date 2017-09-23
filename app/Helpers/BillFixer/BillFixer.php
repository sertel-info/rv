<?php

namespace App\Helpers\BillFixer;

use App\Http\Controllers\Controller;
use App\Models\Cdr;
use App\Models\Linhas\DadosAutenticacaoLinhas;
use App\Models\Linhas\Linhas;
use App\Models\Linhas\DadosConfiguracoesLinhas;
use App\Helpers\AGIClasses\BillCalculator;
use App\Helpers\AGIClasses\Numero;

class BillFixer extends Controller {

	public function verificarDebitos(){
		$linhas = Cdr::where("type", "entrante")
					->where("disposition", "ANSWERED")
					->where("cost", "=", 0.00)
					->where("billsec", ">", 3)
					->where("dst", "08006068174")
					->get()
					->groupBy('dst');

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
				dd($e);
				continue;
			}
			
			foreach($ligacoes as $ligacao){
				$numero = new Numero($ligacao->dst);
				$tarifa = $assinante->planos->__get('valor_'.$numero->getTipo().'_'.($numero->isDDD() ? 'ddd' : 'local'));

				$custo = BillCalculator::calcTarifa($numero->getTipo(), $tarifa, $ligacao->billsec);
				
				$ligacao->cost = $custo;
				//$ligacao->save();
				//$assinante->financeiro->decrement('creditos', $custo);
			}

		}
		
	}

	public function fix0800(){
		$ligacoes = Cdr::where("type", "entrante")
					->where("disposition", "ANSWERED")
					->where("billsec", ">", 3)
					->where("dst", "08006068174")
					->get();

		$dados_linha = DadosAutenticacaoLinhas::where('login_ata', 8174)->first();
		$linha = Linhas::where("id", $dados_linha->linha_id)->first();
		$plano = $linha->plano();

		foreach($ligacoes as $ligacao){
			$num = new Numero($ligacao->src);

			/*if($ligacao->src == "21964221082" || $ligacao->src == "21982644573"){
				dd($ligacao->src);
				$ligacao->delete();
				continue;
			}*/

			if($num->getTipo() == null){
				$tipo = 'movel';
			} else {
				$tipo = $num->getTipo();
			}

			$tarifa = $plano->__get('valor_'  . $tipo . '_entrante');
			$custo = BillCalculator::calcTarifa('movel', $tarifa, $ligacao->billsec);
			$ligacao->cost = $custo;
			$ligacao->save();
		}

	}
}