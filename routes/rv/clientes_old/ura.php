<?php

Route::group(['middleware' => 'auth','prefix'=>'ura'], function(){
        //Route::post('/guardar', 'UraController@store')->name('rvc.ura.store');
        Route::post('/atualizar', 'UraController@update')->name('cliente.ura.update');
        Route::delete('/excluir', 'UraController@destroy')->name('cliente.ura.destroy');
        Route::get('/get', 'UraController@get')->name('cliente.ura.get');
        /*Route::get('/mine/data/{id?}', 'UraController@getMine')->name('rvc.uras.get_mine');*/
        /*Route::get('/data/of/{id?}', 'UraController@getUrasOf')->name('rvc.uras.get_of');*/
        /*Route::get('/get/audio/blob/{ura_id?}/{audio_id?}', 'UraController@getAudioBlob')->name('rvc.uras.audio_blob.get');*/

        //Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')->name('rvc.grupos_atendimento.get');
        //Route::post('/atualizar', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
    });
