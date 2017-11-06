<?php

Route::group(['middleware'=>'token'], function () {
    Route::get('/header/data', 'ClientesController@getHeaderData')->name("cliente.get_header_data");
    Route::get('/unmorph', '\App\Http\Controllers\Auth\AuthUserController@unmorph')->name("cliente.unmorph");

    Route::get('/get/linhas/stats', 'HomeController@getLinhasStats')->name("cliente.get_linhas_stats");
    /*
    Route::get('/criar', 'LinhasController@create')->name("admin.linhas.create");
    Route::get('/gerenciar', 'LinhasController@manage')->name("admin.linhas.manage");
    Route::get('/editar/{id?}', 'LinhasController@edit')->name("admin.linhas.edit");
    Route::get('/pegar/{id?}', 'LinhasController@get')->name("admin.linhas.get");
    */
});

