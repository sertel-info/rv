<?php

Route::group(['middleware' => 'auth', 'prefix'=>'linhas'], function () {
    Route::get('/criar', 'LinhasController@create')->name("rv.linhas.create");
    Route::get('/gerenciar', 'LinhasController@manage')->name("rv.linhas.manage");
    Route::get('/editar/{id?}', 'LinhasController@edit')->name("rv.linhas.edit");
    Route::get('/pegar/{id?}', 'LinhasController@get')->name("rv.linhas.get");
    Route::get('/data', 'LinhasController@datatables')->name("rv.linhas.datatables");
    Route::post('/guardar', 'LinhasController@store')->name("rv.linhas.store");
    Route::put('/atualizar/{id?}', 'LinhasController@update')->name("rv.linhas.update");
    Route::delete('/deletar', 'LinhasController@destroy')->name("rv.linhas.destroy");
});