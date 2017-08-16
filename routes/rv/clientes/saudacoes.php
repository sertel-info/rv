<?php


Route::group(['middleware' => 'auth','prefix'=>'saudacoes'], function(){
        Route::get('/', 'SaudacoesController@index')->name('rvc.saudacoes.index');
        Route::get('/criar', 'SaudacoesController@create')->name('rvc.saudacoes.create');
        Route::post('/guardar', 'SaudacoesController@store')->name('rvc.saudacoes.store');
        Route::get('/editar/{id?}', 'SaudacoesController@edit')->name('rvc.saudacoes.edit');
        Route::put('/atualizar', 'SaudacoesController@update')->name('rvc.saudacoes.update');
        Route::delete('/excluir', 'SaudacoesController@destroy')->name('rvc.saudacoes.destroy');
        Route::get('/data', 'Datatables\SaudacoesDatatables@anyData')->name('rvc.saudacoes.get');
        Route::get('/mine/data', 'SaudacoesController@getMine')->name('rvc.saudacoes.get_mine');
    });
