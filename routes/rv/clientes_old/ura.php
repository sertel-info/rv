<?php

Route::group(['middleware' => 'auth','prefix'=>'ura'], function(){
        Route::get('/', 'UraController@index')->name('rvc.ura.index');
        Route::get('/criar', 'UraController@create')->name('rvc.ura.create');
        Route::post('/guardar', 'UraController@store')->name('rvc.ura.store');
        Route::get('/editar/{id?}', 'UraController@edit')->name('rvc.ura.edit');
        Route::post('/atualizar', 'UraController@update')->name('rvc.ura.update');
        Route::delete('/excluir', 'UraController@destroy')->name('rvc.ura.destroy');
        Route::get('/mine/data/{id?}', 'UraController@getMine')->name('rvc.uras.get_mine');
        Route::get('/data/of/{id?}', 'UraController@getUrasOf')->name('rvc.uras.get_of');
        Route::get('/get/audio/blob/{ura_id?}/{audio_id?}', 'UraController@getAudioBlob')->name('rvc.uras.audio_blob.get');

        //Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')->name('rvc.grupos_atendimento.get');
        //Route::post('/atualizar', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
    });
