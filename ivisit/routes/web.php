<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/login', 'AuthController@login');

//AppUsersRoute
$router->get('app-users', 'AppUsersController@index');
$router->post('app-users/store', 'AppUsersController@store');
$router->get('app-users/{id}/edit', 'AppUsersController@edit');
$router->put('app-users/{id}/update', 'AppUsersController@update');

//SurveyRoutes
$router->get('surveys','SurveysController@index');
$router->post('surveys','SurveysController@store');

