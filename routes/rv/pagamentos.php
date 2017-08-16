<?php

Route::group(['prefix'=>'pagamentos'], function(){

	Route::group(['middleware' => 'auth'], function(){
		Route::get('/mercado', 'PaymentsController@index')->name('rvc.payments.index');
    	Route::get('/pagar', 'PaymentsController@create')->name('rvc.payments.create');
    	Route::get('/finish', 'PaymentsController@finish')->name('rvc.payments.finish');
	});


    Route::post('/notification/check', 'PaymentsController@receiveNotification')
                        ->name('rvc.payments.notifications.recieve');
});

