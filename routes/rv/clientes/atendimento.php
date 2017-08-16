<?php

Route::group(['middleware' => 'auth', 'prefix'=>'atendimento'], function(){
        Route::get('/', 'AtendimentoAutomaticoController@index')->name('rvc.atendimento_automatico.index');
        Route::get('/criar', 'AtendimentoAutomaticoController@create')->name('rvc.atendimento_automatico.create');
        Route::post('/guardar', 'AtendimentoAutomaticoController@store')->name('rvc.atendimento_automatico.store');
        Route::get('/editar/{id?}', 'AtendimentoAutomaticoController@edit')->name('rvc.atendimento_automatico.edit');
        Route::post('/atualizar', 'AtendimentoAutomaticoController@update')->name('rvc.atendimento_automatico.update');
        Route::delete('/excluir', 'AtendimentoAutomaticoController@destroy')->name('rvc.atendimento_automatico.destroy');
    });