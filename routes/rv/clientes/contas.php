<?php

 
Route::group(['middleware' => 'auth','prefix'=>'conta'], function(){
    Route::get('/editar', 'Clientes\ContasController@edit')->name('rvc.conta.edit');
    Route::put('/atualizar', 'Clientes\ContasController@update')->name('rvc.conta.update');
    Route::get('/editar/senha', 'Clientes\ContasController@editPassword')->name('rvc.conta.edit_password');
    Route::put('/atualizar/senha', 'Clientes\ContasController@updatePassword')->name('rvc.conta.update_password');
});