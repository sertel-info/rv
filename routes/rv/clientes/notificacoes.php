<?php

Route::group(['middleware' => 'auth','prefix'=>'notificacoes'], function(){
    Route::get('/minhas', 'Clientes\NotificacoesClientesController@getMyNewNotifications')->name('rvc.notifications.get.my.new');
    Route::post('/mark/seen', 'Clientes\NotificacoesClientesController@markSeen')->name('rvc.notifications.mark.seen');
    Route::get('/', 'Clientes\NotificacoesClientesController@viewAll')->name('rvc.notifications.view.all');
    Route::get('/check/new', 'Clientes\NotificacoesClientesController@checkNew')->name('rvc.notifications.check.new');
    Route::get('/get/old/{page?}', 'Clientes\NotificacoesClientesController@getOld')->name('rvc.notifications.get.old');    
});