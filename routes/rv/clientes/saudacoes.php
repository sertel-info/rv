<?php

Route::group(['middleware' => 'token','prefix'=>'saudacoes'], function(){
    Route::post('/guardar', 'SaudacoesController@store')->name('cliente.saudacoes.store');
    Route::post('/atualizar', 'SaudacoesController@update')->name('cliente.saudacoes.update');
    Route::delete('/excluir', 'SaudacoesController@destroy')->name('cliente.saudacoes.destroy');
    Route::get('/get', 'SaudacoesController@get')->name('cliente.saudacoes.get');
    Route::get('/data', 'Datatables\SaudacoesDatatables@anyData')->name('cliente.saudacoes.data');
    Route::get('/get_audio', 'SaudacoesController@getAudioBlob')->name('cliente.saudacoes.get_audio');
});
