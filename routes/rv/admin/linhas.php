<?php

Route::group(['prefix'=>'linhas', 'middleware'=>'admin'], function () {
    Route::get('/data', 'Datatables\LinhasDatatables@anyData')->name("admin.linhas.datatables");
    Route::post('/guardar', 'LinhasController@store')->name("admin.linhas.store");
    Route::delete('/deletar', 'LinhasController@destroy')->name("admin.linhas.destroy");
    Route::post('/atualizar', 'LinhasController@update')->name("admin.linhas.update");
    Route::get('/linha', 'LinhasController@get')->name("admin.linhas.get");

    /*
    Route::get('/criar', 'LinhasController@create')->name("admin.linhas.create");
    Route::get('/gerenciar', 'LinhasController@manage')->name("admin.linhas.manage");
    Route::get('/editar/{id?}', 'LinhasController@edit')->name("admin.linhas.edit");
    Route::get('/pegar/{id?}', 'LinhasController@get')->name("admin.linhas.get");
    */
});

