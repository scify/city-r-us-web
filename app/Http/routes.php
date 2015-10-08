<?php


Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
