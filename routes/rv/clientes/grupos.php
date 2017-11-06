<?php

Route::group(['middleware' => 'token','prefix'=>'grupos'], function(){
    
    Route::post('/guardar', 'GruposAtendimentoController@store')
                ->name('cliente.grupos_atendimento.store');
   
    Route::post('/atualizar/{id?}', 'GruposAtendimentoController@update')
                ->name('cliente.grupos_atendimento.update');
    
    Route::delete('/excluir', 'GruposAtendimentoController@destroy')
                ->name('cliente.grupos_atendimento.destroy');
   
    Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')
                ->name('cliente.grupos_atendimento.data');

    Route::get('/get', 'GruposAtendimentoController@get')
                ->name('cliente.grupos_atendimento.get');
});