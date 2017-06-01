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

 Route::get('/teste', 'GravacoesController@corrigir');

Route::get('/', 'HomeController@index')->name('index')->middleware("auth");

Route::group(['middleware' => 'auth', 'prefix'=>'configuracoes'], function () {
    Route::get('/', 'ConfiguracoesController@index')->name("rv.configuracoes.index");    
    Route::post('/atualizar', 'ConfiguracoesController@update')->name("rv.configuracoes.update");    
});

Route::group(['middleware' => 'auth', 'prefix'=>'assinantes'], function () {
    Route::get('/criar', 'AssinantesController@create')->name("rv.assinantes.create");
    Route::get('/gerenciar', 'AssinantesController@manage')->name("rv.assinantes.manage");
    Route::get('/editar/{id?}', 'AssinantesController@edit')->name("rv.assinantes.edit");
    Route::get('/pegar/{id?}', 'AssinantesController@get')->name("rv.assinantes.get");
    Route::get('/data', 'AssinantesController@datatables')->name("rv.assinantes.datatables");
    Route::post('/guardar', 'AssinantesController@store')->name("rv.assinantes.store");
    Route::put('/atualizar/{id?}', 'AssinantesController@update')->name("rv.assinantes.update");
    Route::delete('/deletar', 'AssinantesController@destroy')->name("rv.assinantes.destroy");

    Route::group(['prefix'=>'creditos'], function(){
        Route::get('/get', 'AssinantesController@getCredits')->name("rv.assinantes.creditos.get");
        Route::post('/update', 'AssinantesController@updateCredits')->name("rv.assinantes.creditos.update");
    });
});

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


Route::group(['middleware' => 'auth', 'prefix'=>'cliente'], function () {
    /*Route::group(['prefix'=>'contas'], function(){
        Route::get('/', 'BillingController@getContas')->name("rv.cliente.contas");
    });*/

    Route::group(['prefix'=>'configuracoes'], function(){
        Route::get('/', 'ClientesController@config')->name('rvc.config.index');
        Route::put('/linha/atualizar', 'ClientesController@updateLinha')->name('rvc.config.update.linha');
    });

    Route::group(['prefix'=>'gravacoes'], function(){
        Route::get('/', 'GravacoesController@index')->name('rvc.gravacoes.index');
        Route::get('/download', 'GravacoesController@downloadGravacao')->name('rvc.gravacoes.download');
        Route::get('/blob/{id?}', 'GravacoesController@getBlob' )->name('rvc.gravacoes.get_blob');
        Route::get('/get/data', 'Datatables\GravacoesDataTables@anyData')->name('rvc.gravacoes.get');
    });

    Route::group(['prefix'=>'caixa'], function(){
        Route::get('/', 'CorreioVozController@index')->name('rvc.correio_voz.index');
        Route::get('/get', 'CorreioVozController@getGravacoesList')->name('rvc.correio_voz.get');
        Route::get('/download', 'CorreioVozController@downloadGravacao')->name('rvc.correio_voz.download');
        Route::get('/blob/{ramal?}/{id?}', 'CorreioVozController@getBlob' )->name('rvc.correio_voz.get_blob');
    });

    Route::group(['prefix'=>'extrato'], function(){
        Route::get('/', 'ExtratoController@index')->name('rvc.extrato.index');
        //Route::get('/get', 'ExtratoController@dataTables')->name('rvc.extrato.get');
        Route::get('/exibir/{id?}', 'ExtratoController@show')->name('rvc.extrato.show');
        Route::get('/linhas/{id?}', 'Datatables\ExtratoDataTables@anyData')->name('rvc.extrato.linhas.get');
    });

    Route::group(['prefix'=>'conta'], function(){
        Route::get('/editar', 'ClientesController@edit')->name('rvc.conta.edit');
        Route::post('/atualizar', 'ClientesController@update')->name('rvc.conta.update');
    });

});

/*
Route::group(['middleware'=>'auth'], function(){
    Route::get('/', 'HomeController@index');



    Route::group(['prefix'=>'gravacoes'], function(){
        Route::get('/', 'GravacoesController@index')->name('rvc.gravacoes.index');
        Route::get('/get', 'GravacoesController@getGravacoesList')->name('rvc.gravacoes.get');
        Route::get('/download', 'GravacoesController@downloadGravacao')->name('rvc.gravacoes.download');
        Route::get('/blob/{ramal?}/{id?}', 'GravacoesController@getBlob' )->name('rvc.gravacoes.get_blob');
    });


});
*/

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