<?php

namespace App\Helpers\Excel;
use Excel;

class ExtratoCollectionToCsvConverter {


	public function convert(\Illuminate\Support\Collection $collection){
		$extrato = $collection->map(function($el){
						            return collect($el)->only(["origem",
						                                        "destino",
						                                        "date",
						                                        "time",
						                                        "billsec_time",
						                                        "formated_cost",
						                                        "type"])
						                                ->toArray();
						                  });
		$today = (new \DateTime())->format('d_m_Y_h_i_s');
		$file = Excel::create('Extrato_'.$today, function($excel) use ($extrato) {
			
			$excel->setCreator('Sertel-info');
          	$excel->setCompany('Sertel-info');
    		$excel->setDescription('Extrato');

			$excel->sheet('extrato', function($sheet) use ($extrato) {
				$sheet->appendRow(["Origem", "Destino", "Data", "Hora", "Duração", "Tipo", "Valor"]);
				
				foreach($extrato as $el){
					$sheet->appendRow([$el['origem'], $el['destino'], $el['date'], $el['time'], $el['billsec_time'], $el['type'], $el['formated_cost']]);
				}

		    });

		});

		return $file;
	}


}