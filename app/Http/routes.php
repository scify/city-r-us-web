<?php


Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/* Missions Routes */
Route::get('/missions', 'MissionController@index');
Route::get('/missions/create', 'MissionController@create');
Route::get('/missions/{id}', ['as' => 'mission/profile', 'uses' => 'MissionController@show']);
Route::get('/missions/edit/{id}', 'MissionController@edit');
Route::get('/missions/delete/{id}', 'MissionController@delete');
Route::post('/missions/storeFile', 'MissionController@storeFile');
Route::post('/missions/update', 'MissionController@update');
Route::get('/missions/{id}/img/remove', 'MissionController@removeImg');
Route::post('/missions/{id}/img/update', 'MissionController@updateImg');


/* Users Routes */
Route::get('/users', 'UserController@index');
