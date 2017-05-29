<?php

/**
	ROTAS DAS TABELAS COM DATATABLES
**/
Route::group(['namespace'=>'Datatables', 'middleware'=>'auth'], function(){
   	//Route::get('assinantes', 'Assinantes@getIndex')->name('gravacoes.datatables');
    Route::get('/assinantes/data', 'AssinantesDataTables@anyData')->name('rv.datatables.assinantes');

});
