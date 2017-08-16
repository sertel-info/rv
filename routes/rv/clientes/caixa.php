<?php

Route::group(['middleware' => 'auth','prefix'=>'caixa'], function(){
        Route::get('/', 'CorreioVozController@index')->name('rvc.correio_voz.index');
        Route::get('/get', 'CorreioVozController@getGravacoesList')->name('rvc.correio_voz.get');
        Route::get('/download', 'CorreioVozController@downloadGravacao')->name('rvc.correio_voz.download');
        Route::get('/blob/{ramal?}/{id?}', 'CorreioVozController@getBlob' )->name('rvc.correio_voz.get_blob');
    });