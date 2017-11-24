<?php

Route::group(['middleware' => 'token','prefix'=>'filas'], function(){
    Route::get('/', 'FilasController@index')->name('cliente.filas.index');
    Route::post('/guardar', 'FilasController@store')->name('cliente.filas.store');
    Route::post('/atualizar', 'FilasController@update')->name('cliente.filas.update');
    Route::delete('/excluir', 'FilasController@destroy')->name('cliente.filas.destroy');
    Route::get('/get', 'FilasController@get')->name('cliente.filas.get');
    Route::get('/data', 'Datatables\FilasDataTables@anyData')->name('cliente.filas.data');
});