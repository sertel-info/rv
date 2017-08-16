<?php

Route::group(['middleware' => 'auth','prefix'=>'extrato'], function(){
    Route::get('/', 'ExtratoController@index')->name('rvc.extrato.index');
    Route::get('/get', 'ExtratoController@dataTables')->name('rvc.extrato.get');
    Route::get('/exibir/{id?}', 'ExtratoController@show')->name('rvc.extrato.show');
    Route::get('/linha/{id?}', 'Datatables\ExtratoDataTables@anyData')->name('rvc.extrato.linha.data');
    Route::get('/filter/{linha?}', 'Datatables\ExtratoDataTables@filter')->name('rvc.extrato.filter');
    Route::get('/export/', 'ExtratoController@export')->name('rvc.extrato.export');
});