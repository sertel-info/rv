<?php

Route::group(['middleware' => 'auth', 'prefix'=>'planos'], function () {
    Route::get('/criar', 'PlanosController@create')->name("rv.planos.create");
    Route::get('/gerenciar', 'PlanosController@manage')->name("rv.planos.manage");
    Route::get('/editar/{id?}', 'PlanosController@edit')->name("rv.planos.edit");
    Route::get('/pegar/{id?}', 'PlanosController@get')->name("rv.planos.get");
    Route::get('/data', 'PlanosController@datatables')->name("rv.planos.datatables");
    Route::post('/guardar', 'PlanosController@store')->name("rv.planos.store");
    Route::put('/atualizar/{id?}', 'PlanosController@update')->name("rv.planos.update");
    Route::delete('/deletar', 'PlanosController@destroy')->name("rv.planos.destroy");
});