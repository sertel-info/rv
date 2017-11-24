<?php

Route::group(['middleware' => 'token','prefix'=>'config'], function(){
    Route::get('/get_perm_linha', 'ConfiguracoesController@getPermissaoLinha')->name('cliente.config.get_perm_linha');
    
    Route::post('/update_linha', 'ConfiguracoesController@update')->name('cliente.config.update_linha');
    
    Route::get('/get_linha_conf_data', 'ConfiguracoesController@getLinhaConfData')->name('cliente.config.get_linha_conf_data');

	Route::get('/get_at_auto_opts', 'ConfiguracoesController@getAtAutomaticoOpts')
									   ->name('cliente.config.get_at_auto_opts');

	Route::get('/get_saudacoes_list', 'ConfiguracoesController@getSaudacoesList')
									   ->name('cliente.config.get_saudacoes_list');
});