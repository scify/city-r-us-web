<?php

/* Guest Routes */
Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);
Route::post('/', 'HomeController@mail');
Route::get('/dashboard', ['as' => 'admin/home', 'uses' => 'AdminController@index']);
Route::get('/termsAndConditions', 'HomeController@termsAndConditions');
Route::get('/city-map', 'HomeController@citymap');
Route::get('/city-map/venues', 'HomeController@getVenues');
Route::get('/city-map/events', 'HomeController@getEvents');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/* Missions Routes */
Route::get('/missions', ['as' => 'missions', 'uses' => 'MissionController@index']);
Route::get('/missions/create', 'MissionController@create');
Route::get('/missions/{id}', ['as' => 'mission/profile', 'uses' => 'MissionController@show']);
Route::get('/missions/{id}/observations','MissionController@getObservations');
Route::get('/missions/edit/{id}', 'MissionController@edit');
Route::get('/missions/delete/{id}', 'MissionController@delete');
Route::post('/missions/store', 'MissionController@store');
Route::post('/missions/update', 'MissionController@update');
Route::get('/missions/{id}/img/remove', 'MissionController@removeImg');
Route::post('/missions/{id}/img/update', 'MissionController@updateImg');

/* Users Routes */
Route::get('/users', ['as' => 'users', 'uses' => 'UserController@index']);
Route::get('/users/{mission}', 'UserController@index');
Route::post('/users/emailUser', 'UserController@emailUser');
