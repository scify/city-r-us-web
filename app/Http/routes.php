<?php

Route::get('/city-map/venues', 'HomeController@getVenues');
Route::get('/city-map/events', 'HomeController@getEvents');
Route::get('/city-map', 'HomeController@citymap');
Route::get('/city-map/venues', 'HomeController@getVenues');
Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);
Route::get('/dashboard', 'AdminController@index');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/* Missions Routes */
Route::get('/missions', ['as' => 'missions', 'uses' => 'MissionController@index']);
Route::get('/missions/{id}/observations','MissionController@getObservations');
Route::get('/missions/create', 'MissionController@create');
Route::get('/missions/{id}', ['as' => 'mission/profile', 'uses' => 'MissionController@show']);
Route::get('/missions/edit/{id}', 'MissionController@edit');
Route::get('/missions/delete/{id}', 'MissionController@delete');
Route::post('/missions/store', 'MissionController@store');
Route::post('/missions/update', 'MissionController@update');
Route::get('/missions/{id}/img/remove', 'MissionController@removeImg');
Route::post('/missions/{id}/img/update', 'MissionController@updateImg');


/* Users Routes */
Route::get('/users', 'UserController@index');
