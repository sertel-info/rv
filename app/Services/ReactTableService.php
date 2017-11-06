<?php

namespace App\Services;

class ReactTableService {
	/**
	*	Classe usada para montar uma response que será
	*   Usada em uma tabela do React
	*/
	private $data;
	private $total_records;

	public function setData($collection){
		$this->data = $collection;
	}

	public function setTotalRecords($total){
		$this->total_records = $total;
	}

	public function getResponse(){
		$obj = [];
		$obj["total_records"] = $this->total_records;
		$obj["data"]=array_values($this->data->toArray());
		
		return json_encode($obj);
	}

}