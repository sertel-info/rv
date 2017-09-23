<?php
/*
Route::group(['middleware' => 'auth','prefix'=>'planos'], function () {
    Route::get('/criar', 'PlanosController@create')->name("rv.planos.create");
    Route::get('/gerenciar', 'PlanosController@manage')->name("rv.planos.manage");
    Route::get('/editar/{id?}', 'PlanosController@edit')->name("rv.planos.edit");
    Route::get('/pegar/{id?}', 'PlanosController@get')->name("rv.planos.get");
    Route::get('/data', 'PlanosController@datatables')->name("rv.planos.datatables");
    Route::post('/guardar', 'PlanosController@store')->name("rv.planos.store");
    Route::put('/atualizar/{id?}', 'PlanosController@update')->name("rv.planos.update");
    Route::delete('/deletar', 'PlanosController@destroy')->name("rv.planos.destroy");
});
*/

Route::group(['middleware' => 'auth', 'prefix'=>'notificacoes/volateis', 'namespace'=>"Admin\NotificacoesFlash"], function () {
    Route::get('/create/{a?}', 'NotificacoesFlashController@create')->name("rv.notifications.flash.create");
    Route::post('/store/{a?}', 'NotificacoesFlashController@store')->name("rv.notifications.flash.store");
    Route::post('/mark/seen', 'NotificacoesFlashController@markSeen')->name("rv.notifications.flash.mark.seen");
   // Route::get('/get/olg', 'NotificacoesFlashController@markSeen')->name("rv.notifications.flash.mark.seen");
});