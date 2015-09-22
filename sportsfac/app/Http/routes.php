<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('gyms', 'GymController@index');
Route::get('gyms/json', 'GymController@json');

Route::get('gyms/{id}', [
    'as'   => 'gyms.profile',
    'uses' => 'GymController@show'
]);

Route::get('gyms/refresh/{id}', [
    'as'   => 'gyms.refresh',
    'uses' => 'GymController@refreshTimetable'
]);

Route::get('gyms/compare/{id}', [
    'as'   => 'gyms.compare',
    'uses' => 'GymController@addCompare'
]);

Route::post('gyms/infobox', 'GymController@infobox');
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('contribute/{id}', [
    //'as'   => 'gyms.profile',
    'uses' => 'CrowdSourcingController@show'
]);

Route::post('contribute/add','CrowdSourcingController@store');


