<?php

Route::group(['middleware' => 'token','prefix'=>'extrato'], function(){
   	
	Route::get('/extrato/transacoes/get', 'Datatables\ExtratoDataTables@transactionsAnyData')
			->name('cliente.extrato.trasacoes.get');

  Route::get('/historico/ligacoes/get', 'Datatables\ExtratoDataTables@ligacoesAnyData')
      ->name('cliente.extrato.ligacoes.get');

  
  Route::get('/historico/ligacoes/export', 'ExtratoController@export')
      ->name('cliente.extrato.ligacoes.export');
   /* 
    Route::get('/', 'ExtratoController@index')->name('rvc.extrato.index');
    Route::get('/get', 'ExtratoController@dataTables')->name('rvc.extrato.get');
    Route::get('/exibir/{id?}', 'ExtratoController@show')->name('rvc.extrato.show');
    Route::get('/linha/{id?}', 'Datatables\ExtratoDataTables@anyData')->name('rvc.extrato.linha.data');
    Route::get('/filter/{linha?}', 'Datatables\ExtratoDataTables@filter')->name('rvc.extrato.filter');
    Route::get('/export/', 'ExtratoController@export')->name('rvc.extrato.export');
    Route::get('/historico/ligacoes/get', 'Datatables\ExtratoDataTables@transactionsAnyData')->name('rvc.extrato.hist_transacoes.get_mine');*/
});
