<?php

Route::group(['middleware' => 'auth', 'prefix'=>'billing'], function(){
    Route::get('/', 'BillingController@getContas')->name("rv.cliente.contas");
});