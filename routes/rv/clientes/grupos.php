<?php

Route::group(['middleware' => 'auth','prefix'=>'grupos'], function(){
    Route::get('/', 'GruposAtendimentoController@index')->name('rvc.grupos_atendimento.index');
    Route::get('/criar', 'GruposAtendimentoController@create')->name('rvc.grupos_atendimento.create');
    Route::post('/guardar', 'GruposAtendimentoController@store')->name('rvc.grupos_atendimento.store');
    Route::get('/editar/{id?}', 'GruposAtendimentoController@edit')->name('rvc.grupos_atendimento.edit');
    Route::put('/atualizar/{id?}', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
    Route::delete('/excluir', 'GruposAtendimentoController@destroy')->name('rvc.grupos_atendimento.destroy');
    Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')->name('rvc.grupos_atendimento.get');
    Route::get('/mine/data', 'GruposAtendimentoController@getMine')->name('rvc.grupos_atendimento.get_mine');
    Route::get('/data/of/{id?}', 'GruposAtendimentoController@getGruposOf')->name('rvc.grupos_atendimento.get_of');
    //Route::post('/atualizar', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
});