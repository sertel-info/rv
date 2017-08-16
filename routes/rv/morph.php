<?php

Route::group(['middleware' => 'auth','prefix'=>'morph'], function(){
    Route::get('/morph/exec/{id?}', 'MorphController@exec')->name('rv.morph');    
    Route::get('/morph/finish/', 'MorphController@unmorph')->name('rv.unmorph');    
});