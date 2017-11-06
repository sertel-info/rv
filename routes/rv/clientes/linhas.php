<?php

Route::group(['middleware' => 'token','prefix'=>'linhas'], function(){
    
    Route::get('/get/list', 'LinhasController@getList')->name('cliente.linhas.get_list');

});