<?php

Route::group(['middleware' => 'admin', 'prefix'=>'configuracoes'], function () {
    Route::get('/get', 'ConfiguracoesController@get')->name("admin.configuracoes.get");
    Route::post('/atualizar', 'ConfiguracoesController@update')->name("admin.configuracoes.update");
});