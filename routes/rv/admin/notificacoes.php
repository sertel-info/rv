<?php

Route::group(['middleware' => 'admin', 'prefix'=>'notificacoes'], function () {
    Route::post('/store', 'NotificacoesController@store')->name("admin.notif.store");
    Route::post('/update', 'NotificacoesController@update')->name("admin.notif.update");
    Route::delete('/destroy', 'NotificacoesController@destroy')->name("admin.notif.destroy");
    Route::get('/data', 'Datatables\NotificacoesDatatables@anyData')->name("admin.notif.data");
    Route::get('/get', 'NotificacoesController@get')->name("admin.notif.get");
    /*Route::post('/mark/seen', 'NotificacoesFlashController@markSeen')->name("rv.notifications.flash.mark.seen");*/
   // Route::get('/get/olg', 'NotificacoesFlashController@markSeen')->name("rv.notifications.flash.mark.seen");
});