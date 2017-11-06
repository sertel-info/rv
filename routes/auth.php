<?php

Route::post('/signin', 'Auth\AuthUserController@signin')->name("auth.signin");
Route::post('/signup', 'Auth\AuthUserController@signup')->name("auth.signup")->middleware('token');
Route::get('/signout', 'Auth\AuthUserController@signout')->name("auth.signout");
Route::get('/login', 'Auth\AuthUserController@login')->name("auth.login");

