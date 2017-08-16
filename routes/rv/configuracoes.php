<?php

Route::group(['middleware' => 'auth',
              'prefix'=>'configuracoes', 
              'namespace'=>"Admin\Configuracoes"],
               function () {
                
                Route::group(['prefix'=>'geral'], function () {
                    Route::get('/', 'ConfigGeralController@index')->name("rv.configuracoes.geral");
                    Route::post('/udpate', 'ConfigGeralController@update')->name("rv.configuracoes.geral.update");
                });
                
                Route::group(['prefix'=>'voice_mail'], function () {
                    Route::get('/', 'ConfigVoiceMailController@index')->name("rv.configuracoes.voice_mail");    
                    Route::post('/update', 'ConfigVoiceMailController@update')->name("rv.configuracoes.voice_mail.update");
                });

                Route::group(['prefix'=>'notificacoes'], function () {

                    Route::get('/', 'ConfigNotificacoesController@index')->name("rv.configuracoes.notificacoes");
                    Route::post('/update/{n?}', 'ConfigNotificacoesController@update')->name("rv.configuracoes.notificacoes.update");
                    Route::get('/edit/{n?}', 'ConfigNotificacoesController@edit')->name("rv.configuracoes.notificacoes.edit");
                    Route::get('/create', 'ConfigNotificacoesController@create')->name("rv.configuracoes.notificacoes.create");
                    Route::post('/store', 'ConfigNotificacoesController@store')->name("rv.configuracoes.notificacoes.store");
                    Route::delete('/destroy', 'ConfigNotificacoesController@destroy')->name("rv.configuracoes.notificacoes.destroy");
                    Route::get('/data', '\App\Http\Controllers\Datatables\NotificacoesDatatables@anyData')->name("rv.configuracoes.notificacoes.get_data");
                });

                //Route::post('/atualizar', 'ConfiguracoesController@update')->name("rv.configuracoes.update");
                }
);