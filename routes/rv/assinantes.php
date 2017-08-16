<?php

Route::group(['middleware' => 'auth', 'prefix'=>'assinantes'], function () {
    Route::get('/criar', 'AssinantesController@create')->name("rv.assinantes.create");
    Route::get('/gerenciar', 'AssinantesController@manage')->name("rv.assinantes.manage");
    Route::get('/editar/{id?}', 'AssinantesController@edit')->name("rv.assinantes.edit");
    Route::get('/pegar/{id?}', 'AssinantesController@get')->name("rv.assinantes.get");
    Route::get('/data', 'Datatables\AssinantesDataTables@anyData')->name("rv.assinantes.datatables");
    Route::post('/guardar', 'AssinantesController@store')->name("rv.assinantes.store");
    Route::put('/atualizar/{id?}', 'AssinantesController@update')->name("rv.assinantes.update");
    Route::delete('/deletar', 'AssinantesController@destroy')->name("rv.assinantes.destroy");

    Route::group(['prefix'=>'creditos', 'namespace'=>'Clientes'], function(){
        Route::get('/get', 'CreditosController@getCredits')->name("rv.assinantes.creditos.get");
        Route::post('/increase', 'CreditosController@increase')->name("rv.assinantes.creditos.increase");
        Route::post('/decrease', 'CreditosController@decrease')->name("rv.assinantes.creditos.decrease");
    });
});