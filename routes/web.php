<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/teste', "PaymentsController@test");

Route::get('/', 'HomeController@index')->middleware("auth")->name("index");
Route::get('/home', 'HomeController@index')->middleware("auth")->name("index");

/*
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
); */

/*
Route::group(['middleware' => 'auth', 'prefix'=>'assinantes'], function () {
    Route::get('/criar', 'AssinantesController@create')->name("rv.assinantes.create");
    Route::get('/gerenciar', 'AssinantesController@manage')->name("rv.assinantes.manage");
    Route::get('/editar/{id?}', 'AssinantesController@edit')->name("rv.assinantes.edit");
    Route::get('/pegar/{id?}', 'AssinantesController@get')->name("rv.assinantes.get");
    Route::get('/data', 'Datatables\AssinantesDataTables@anyData')->name("rv.assinantes.datatables");
    Route::post('/guardar', 'AssinantesController@store')->name("rv.assinantes.store");
    Route::put('/atualizar/{id?}', 'AssinantesController@update')->name("rv.assinantes.update");
    Route::delete('/deletar', 'AssinantesController@destroy')->name("rv.assinantes.destroy");

    Route::group(['prefix'=>'creditos', 'namespace'=>'Clientes'], function(){
        Route::get('/get', 'CreditosController@getCredits')->name("rv.assinantes.creditos.get");
        Route::post('/increase', 'CreditosController@increase')->name("rv.assinantes.creditos.increase");
        Route::post('/decrease', 'CreditosController@decrease')->name("rv.assinantes.creditos.decrease");
    });
});
*/

/*

Route::group(['middleware' => 'auth', 'prefix'=>'linhas'], function () {
    Route::get('/criar', 'LinhasController@create')->name("rv.linhas.create");
    Route::get('/gerenciar', 'LinhasController@manage')->name("rv.linhas.manage");
    Route::get('/editar/{id?}', 'LinhasController@edit')->name("rv.linhas.edit");
    Route::get('/pegar/{id?}', 'LinhasController@get')->name("rv.linhas.get");
    Route::get('/data', 'LinhasController@datatables')->name("rv.linhas.datatables");
    Route::post('/guardar', 'LinhasController@store')->name("rv.linhas.store");
    Route::put('/atualizar/{id?}', 'LinhasController@update')->name("rv.linhas.update");
    Route::delete('/deletar', 'LinhasController@destroy')->name("rv.linhas.destroy");
});

*/

/*
Route::group(['middleware' => 'auth', 'prefix'=>'planos'], function () {
    Route::get('/criar', 'PlanosController@create')->name("rv.planos.create");
    Route::get('/gerenciar', 'PlanosController@manage')->name("rv.planos.manage");
    Route::get('/editar/{id?}', 'PlanosController@edit')->name("rv.planos.edit");
    Route::get('/pegar/{id?}', 'PlanosController@get')->name("rv.planos.get");
    Route::get('/data', 'PlanosController@datatables')->name("rv.planos.datatables");
    Route::post('/guardar', 'PlanosController@store')->name("rv.planos.store");
    Route::put('/atualizar/{id?}', 'PlanosController@update')->name("rv.planos.update");
    Route::delete('/deletar', 'PlanosController@destroy')->name("rv.planos.destroy");
});

*/

/*
Route::group(['middleware' => 'auth', 'prefix'=>'notificacoes/volateis', 'namespace'=>"Admin\NotificacoesFlash"], function () {
    Route::get('/create/{a?}', 'NotificacoesFlashController@create')->name("rv.notifications.flash.create");
    Route::post('/store/{a?}', 'NotificacoesFlashController@store')->name("rv.notifications.flash.store");
    Route::post('/mark/seen', 'NotificacoesFlashController@markSeen')->name("rv.notifications.flash.mark.seen");
});
*/

/*
Route::group(['prefix'=>'morph'], function(){
    Route::get('/morph/exec/{id?}', 'MorphController@exec')->name('rv.morph');    
    Route::get('/morph/finish/', 'MorphController@unmorph')->name('rv.unmorph');    
});
*/



Route::group(['middleware' => 'auth', 'prefix'=>'cliente'], function () {
   
    /*
    Route::group(['prefix'=>'billing'], function(){
        Route::get('/', 'BillingController@getContas')->name("rv.cliente.contas");
    });
    */

    Route::get('/linhas/get', 'ClientesController@getLinhas')->name('rvc.get.linhas');
    Route::get('/grupos/get', 'ClientesController@getGrupos')->name('rvc.get.grupos');
   
    /*Route::group(['prefix'=>'conta'], function(){
        Route::get('/editar', 'Clientes\ContasController@edit')->name('rvc.conta.edit');
        Route::put('/atualizar', 'Clientes\ContasController@update')->name('rvc.conta.update');
        Route::get('/editar/senha', 'Clientes\ContasController@editPassword')->name('rvc.conta.edit_password');
        Route::put('/atualizar/senha', 'Clientes\ContasController@updatePassword')->name('rvc.conta.update_password');
    });*/

    /*Route::group(['prefix'=>'notificacoes'], function(){
        Route::get('/minhas', 'Clientes\NotificacoesClientesController@getMyNewNotifications')->name('rvc.notifications.get.my.new');
        Route::post('/mark/seen', 'Clientes\NotificacoesClientesController@markSeen')->name('rvc.notifications.mark.seen');
        Route::get('/get/old/{page?}', 'Clientes\NotificacoesClientesController@getOld')->name('rvc.notifications.get.old');
        Route::get('/', 'Clientes\NotificacoesClientesController@viewAll')->name('rvc.notifications.view.all');
        Route::get('/check/new', 'Clientes\NotificacoesClientesController@checkNew')->name('rvc.notifications.check.new');
    });
    */
    
    /*Route::group(['prefix'=>'configuracoes'], function(){

        Route::get('/', 'ClientesController@index')->name('rvc.config.index');
        Route::get('/edit/{id?}', 'ClientesController@config')->name('rvc.config.edit');
        Route::put('/linha/atualizar', 'ClientesController@updateLinha')->name('rvc.config.update.linha');

    });*/

    /*
        Route::group(['prefix'=>'gravacoes'], function(){
        Route::get('/', 'GravacoesController@index')->name('rvc.gravacoes.index');
        //Route::get('/get', 'GravacoesController@dataTables')->name('rvc.gravacoes.get');
        Route::get('/data', 'Datatables\GravacoesDatatables@anyData')->name('rvc.gravacoes.get');
        Route::get('/download', 'GravacoesController@downloadGravacao')->name('rvc.gravacoes.download');
        Route::get('/blob/{id?}', 'GravacoesController@getBlob' )->name('rvc.gravacoes.get_blob');
    });*/

    /*Route::group(['prefix'=>'caixa'], function(){
        Route::get('/', 'CorreioVozController@index')->name('rvc.correio_voz.index');
        Route::get('/get', 'CorreioVozController@getGravacoesList')->name('rvc.correio_voz.get');
        Route::get('/download', 'CorreioVozController@downloadGravacao')->name('rvc.correio_voz.download');
        Route::get('/blob/{ramal?}/{id?}', 'CorreioVozController@getBlob' )->name('rvc.correio_voz.get_blob');
    });*/

    /*Route::group(['prefix'=>'extrato'], function(){
        Route::get('/', 'ExtratoController@index')->name('rvc.extrato.index');
        Route::get('/get', 'ExtratoController@dataTables')->name('rvc.extrato.get');
        Route::get('/exibir/{id?}', 'ExtratoController@show')->name('rvc.extrato.show');
        Route::get('/linha/{id?}', 'Datatables\ExtratoDataTables@anyData')->name('rvc.extrato.linha.data');
        Route::get('/filter/{linha?}', 'Datatables\ExtratoDataTables@filter')->name('rvc.extrato.filter');
        Route::get('/export/', 'ExtratoController@export')->name('rvc.extrato.export');
    });*/


    /*Route::group(['prefix'=>'grupos'], function(){
        Route::get('/', 'GruposAtendimentoController@index')->name('rvc.grupos_atendimento.index');
        Route::get('/criar', 'GruposAtendimentoController@create')->name('rvc.grupos_atendimento.create');
        Route::post('/guardar', 'GruposAtendimentoController@store')->name('rvc.grupos_atendimento.store');
        Route::get('/editar/{id?}', 'GruposAtendimentoController@edit')->name('rvc.grupos_atendimento.edit');
        Route::put('/atualizar/{id?}', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
        Route::delete('/excluir', 'GruposAtendimentoController@destroy')->name('rvc.grupos_atendimento.destroy');
        Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')->name('rvc.grupos_atendimento.get');
        Route::get('/mine/data', 'GruposAtendimentoController@getMine')->name('rvc.grupos_atendimento.get_mine');
        Route::get('/data/of/{id?}', 'GruposAtendimentoController@getGruposOf')->name('rvc.grupos_atendimento.get_of');
        //Route::post('/atualizar', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
    });*/

    /*Route::group(['prefix'=>'ura'], function(){
        Route::get('/', 'UraController@index')->name('rvc.ura.index');
        Route::get('/criar', 'UraController@create')->name('rvc.ura.create');
        Route::post('/guardar', 'UraController@store')->name('rvc.ura.store');
        Route::get('/editar/{id?}', 'UraController@edit')->name('rvc.ura.edit');
        Route::post('/atualizar', 'UraController@update')->name('rvc.ura.update');
        Route::delete('/excluir', 'UraController@destroy')->name('rvc.ura.destroy');
        Route::get('/mine/data/{id?}', 'UraController@getMine')->name('rvc.uras.get_mine');
        Route::get('/data/of/{id?}', 'UraController@getUrasOf')->name('rvc.uras.get_of');
        Route::get('/get/audio/blob/{ura_id?}/{audio_id?}', 'UraController@getAudioBlob')->name('rvc.uras.audio_blob.get');

        //Route::get('/data', 'Datatables\GruposAtendimentoDatatables@anyData')->name('rvc.grupos_atendimento.get');
        //Route::post('/atualizar', 'GruposAtendimentoController@update')->name('rvc.grupos_atendimento.update');
    });*/

    /*Route::group(['prefix'=>'filas'], function(){
        Route::get('/', 'FilasController@index')->name('rvc.filas.index');
        Route::get('/criar', 'FilasController@create')->name('rvc.filas.create');
        Route::post('/guardar', 'FilasController@store')->name('rvc.filas.store');
        Route::get('/editar/{id?}', 'FilasController@edit')->name('rvc.filas.edit');
        Route::put('/atualizar', 'FilasController@update')->name('rvc.filas.update');
        Route::delete('/excluir', 'FilasController@destroy')->name('rvc.filas.destroy');
        Route::get('/data', 'Datatables\FilasDataTables@anyData')->name('rvc.filas.get');
        Route::get('/mine/data', 'FilasController@getMine')->name('rvc.filas.get_mine');
        Route::get('/data/of/{id?}', 'FilasController@getFilasOf')->name('rvc.filas.get_of');
    });*/


    /*Route::group(['prefix'=>'atendimento'], function(){
        Route::get('/', 'AtendimentoAutomaticoController@index')->name('rvc.atendimento_automatico.index');
        Route::get('/criar', 'AtendimentoAutomaticoController@create')->name('rvc.atendimento_automatico.create');
        Route::post('/guardar', 'AtendimentoAutomaticoController@store')->name('rvc.atendimento_automatico.store');
        Route::get('/editar/{id?}', 'AtendimentoAutomaticoController@edit')->name('rvc.atendimento_automatico.edit');
        Route::post('/atualizar', 'AtendimentoAutomaticoController@update')->name('rvc.atendimento_automatico.update');
        Route::delete('/excluir', 'AtendimentoAutomaticoController@destroy')->name('rvc.atendimento_automatico.destroy');
    });*/


    /*Route::group(['prefix'=>'saudacoes'], function(){
        Route::get('/', 'SaudacoesController@index')->name('rvc.saudacoes.index');
        Route::get('/criar', 'SaudacoesController@create')->name('rvc.saudacoes.create');
        Route::post('/guardar', 'SaudacoesController@store')->name('rvc.saudacoes.store');
        Route::get('/editar/{id?}', 'SaudacoesController@edit')->name('rvc.saudacoes.edit');
        Route::put('/atualizar', 'SaudacoesController@update')->name('rvc.saudacoes.update');
        Route::delete('/excluir', 'SaudacoesController@destroy')->name('rvc.saudacoes.destroy');
        Route::get('/data', 'Datatables\SaudacoesDatatables@anyData')->name('rvc.saudacoes.get');
        Route::get('/mine/data', 'SaudacoesController@getMine')->name('rvc.saudacoes.get_mine');
    });*/


    /*Route::group(['prefix'=>'audios'], function(){
        Route::get('/get/saudacao/{f?}', 'SaudacoesController@getAudioBlob')->name('rvc.saudacoes.audios.get_blob');
        Route::get('/get/uras/{f?}', 'UraController@getAudioBlob')->name('rvc.uras.audios.get_blob');
    });*/


    /*Route::group(['prefix'=>'pagamentos', 'namespace'=>'Clientes'], function(){
        Route::get('/mercado', 'PaymentsController@index')->name('rvc.payments.index');
        Route::get('/pagar', 'PaymentsController@create')->name('rvc.payments.create');
        Route::get('/notification/check', 'PaymentsController@receiveNotification')->name('rvc.payments.notifications.recieve');
        Route::get('/finish', 'PaymentsController@finish')->name('rvc.payments.finish')
                                                         ;
    });*/

});


Auth::routes();

Route::get("/debug", function(){
        foreach(config('app.asterisk_files') as $key=>$file){
            $pasta = implode("/", array_slice(explode("/", $file), 0, -1) );
            
            if(is_writable($pasta)){
                echo "<p> PASTA $pasta <span style='color:green'> [CORRETO] </span></p>";
            } else {
                echo "<p> PASTA $pasta <span style='color:red'> [ERRO] </span></p>";
            }

            if(is_writable($file)){
                echo "<p> ARQUIVO ( $file ) <span style='color:green'> [CORRETO] </span></p>";
            } else {
                echo "<p> ARQUIVO ( $file ) <span style='color:red'> [ERRO] </span> </p>";
            }

            echo "---------------------------------------";
        }
});