<?php

Route::group(['middleware' => 'auth','prefix'=>'gravacoes'], function(){
    Route::get('/', 'GravacoesController@index')->name('rvc.gravacoes.index');
    //Route::get('/get', 'GravacoesController@dataTables')->name('rvc.gravacoes.get');
    Route::get('/data', 'Datatables\GravacoesDatatables@anyData')->name('rvc.gravacoes.get');
    Route::get('/download', 'GravacoesController@downloadGravacao')->name('rvc.gravacoes.download');
    Route::get('/blob/{id?}', 'GravacoesController@getBlob' )->name('rvc.gravacoes.get_blob');
});