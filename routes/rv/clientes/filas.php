<?php

Route::group(['middleware' => 'auth','prefix'=>'filas'], function(){
        Route::get('/', 'FilasController@index')->name('rvc.filas.index');
        Route::get('/criar', 'FilasController@create')->name('rvc.filas.create');
        Route::post('/guardar', 'FilasController@store')->name('rvc.filas.store');
        Route::get('/editar/{id?}', 'FilasController@edit')->name('rvc.filas.edit');
        Route::put('/atualizar', 'FilasController@update')->name('rvc.filas.update');
        Route::delete('/excluir', 'FilasController@destroy')->name('rvc.filas.destroy');
        Route::get('/data', 'Datatables\FilasDataTables@anyData')->name('rvc.filas.get');
        Route::get('/mine/data', 'FilasController@getMine')->name('rvc.filas.get_mine');
        Route::get('/data/of/{id?}', 'FilasController@getFilasOf')->name('rvc.filas.get_of');
    });