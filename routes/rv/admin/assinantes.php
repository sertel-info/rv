<?php

Route::group(['middleware' => 'admin', 'prefix'=>'assinantes'], function () {
    Route::delete('/deletar', 'AssinantesController@destroy')->name("admin.assinantes.destroy");
    Route::get('/get/all', 'AssinantesController@getAll')->name("admin.assinantes.get_all");
    Route::get('/get', 'AssinantesController@get')->name("admin.assinantes.get");
    Route::get('/data', 'Datatables\AssinantesDataTables@anyData')->name("admin.assinantes.datatables");
    Route::post('/guardar', 'AssinantesController@store')->name("admin.assinantes.store");
    Route::post('/atualizar', 'AssinantesController@update')->name("admin.assinantes.update");
    Route::get('/morph/exec', 'Auth\AuthUserController@morph')->name('admin.assinantes.morph');    
    Route::get('/morph/finish/', 'Auth\AuthUserController@unmorph')->name('admin.assinantes.unmorph');

    /*créditos*/
    Route::post('/increase', 'CreditosController@increase')->name("rv.assinantes.creditos.increase");
    Route::post('/decrease', 'CreditosController@decrease')->name("rv.assinantes.creditos.decrease");
});