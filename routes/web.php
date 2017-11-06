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

//Route::get('/teste', "DebugController@correctBill");

Route::get('/', 'HomeController@index')->name("/");

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