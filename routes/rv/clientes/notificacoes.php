<?php
Route::group(['middleware' => 'token','prefix'=>'notificacoes'], function(){
    
    Route::get('/get/new', 'NotificacoesController@getNewNotifications')->name('cliente.notificacoes.get_new');
    Route::get('/get/list', 'NotificacoesController@getList')->name('cliente.notificacoes.get_list');
    Route::post('/mark', 'NotificacoesController@mark')->name('cliente.notificacoes.mark');

});