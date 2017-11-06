<?php

Route::group(['middleware' => 'admin', 'prefix'=>'planos'], function () {
    Route::get('/data', 'Datatables\PlanosDatatables@anyData')->name("admin.planos.datatables");
    Route::get('/get/all', 'PlanosController@getAll')->name("admin.planos.get_all");
    Route::get('/get', 'PlanosController@get')->name("admin.planos.get");
    Route::delete('/deletar', 'PlanosController@destroy')->name("admin.planos.destroy");
    Route::post('/guardar', 'PlanosController@store')->name("admin.planos.store");
    Route::post('/atualizar', 'PlanosController@update')->name("admin.planos.update");

    /*Route::get('/criar', 'PlanosController@create')->name("admin.planos.create");
    Route::get('/gerenciar', 'PlanosController@manage')->name("admin.planos.manage");
    Route::get('/editar/{id?}', 'PlanosController@edit')->name("admin.planos.edit");
    Route::get('/pegar/{id?}', 'PlanosController@get')->name("admin.planos.get");
    */
});