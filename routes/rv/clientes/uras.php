<?php

Route::group(['middleware' => 'token','prefix'=>'ura'], function(){
        Route::post('/guardar', 'UrasController@store')->name('cliente.uras.store');
        Route::post('/atualizar', 'UrasController@update')->name('cliente.uras.update');
        Route::delete('/excluir', 'UrasController@destroy')->name('cliente.uras.destroy');
        Route::get('/get', 'UrasController@get')->name('cliente.uras.get');
        Route::get('/get_options', 'UrasController@getOptions')->name('cliente.uras.get_options');
        Route::get('/get_audio', 'UrasController@getAudioBlob')->name('cliente.uras.get_audio');
        Route::get('/data', 'Datatables\UrasDatatables@anyData')->name('cliente.uras.data');
        /*Route::get('/mine/data/{id?}', 'UraController@getMine')->name('rvc.uras.get_mine');*/
        /*Route::get('/data/of/{id?}', 'UraController@getUrasOf')->name('rvc.uras.get_of');*/
        /*Route::get('/get/audio/blob/{ura_id?}/{audio_id?}', 'UraController@getAudioBlob')->name('rvc.uras.audio_blob.get');*/

        //Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')->name('rvc.grupos_atendimento.get');
        //Route::post('/atualizar', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
    });
