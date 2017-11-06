<?php

Route::group(['middleware' => 'auth','prefix'=>'configuracoes'], function(){

    Route::get('/', 'ClientesController@index')->name('rvc.config.index');
    Route::get('/edit/{id?}', 'ClientesController@config')->name('rvc.config.edit');
    Route::put('/linha/atualizar', 'ClientesController@updateLinha')->name('rvc.config.update.linha');

});