<?php

Route::group(['middleware' => 'token','prefix'=>'caixa'], function(){
    Route::get('/data', 'CorreioVozController@getGravacoesList')->name('cliente.correio_voz.data');
    Route::get('/download', 'CorreioVozController@downloadGravacao')->name('cliente.correio_voz.download');
    Route::get('/blob/{ramal?}/{id?}', 'CorreioVozController@getBlob' )->name('cliente.correio_voz.get_blob');
});