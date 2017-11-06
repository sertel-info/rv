<?php

Route::group(['middleware' => 'auth', 'prefix'=>'audios'], function(){
        Route::get('/get/saudacao/{f?}', 'SaudacoesController@getAudioBlob')->name('rvc.saudacoes.audios.get_blob');
        Route::get('/get/uras/{f?}', 'UraController@getAudioBlob')->name('rvc.uras.audios.get_blob');
    });