<?php

Route::group(['middleware' => 'token',' prefix'=>'gravacoes'], function(){
    Route::get('/data', 'Datatables\GravacoesDatatables@anyData')->name('cliente.gravacoes.data');
    Route::get('/download', 'GravacoesController@download')->name('cliente.gravacoes.download');
    Route::get('/blob', 'GravacoesController@download' )->name('cliente.gravacoes.get_blob');
});