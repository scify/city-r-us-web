<?php


Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);




/* Missions Routes */
Route::get('/missions', 'MissionController@index');



/* Users Routes */
Route::get('/users', 'UserController@index');
