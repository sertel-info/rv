<?php

Route::group(['middleware' => 'admin', 'prefix'=>'notificacoes/v', 'namespace'=>"Admin\NotificacoesFlash"], function () {
    Route::post('/store', 'NotificacoesFlashController@store')->name("admin.notif.flash.store");
    //Route::post('/mark/seen', 'NotificacoesFlashController@markSeen')->name("rv.notifications.flash.mark.seen");
});