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

Route::get('/', ['as' => 'home', 'uses' => 'CustomGroup\LocationController@getLocation']);

Route::post('/', ['as' => 'home', 'uses' => 'CustomGroup\LocationController@setLocation']);

Route::post('/map', ['as' => 'map', 'uses' => 'CustomGroup\ClientLocation@setLocation']);

Route::get('/map/{id?}/{token?}', ['as' => 'map', 'uses' => 'SendMapGroup\MapController@index']);

Route::get('/courierMap/{id?}/{idMap?}/{number?}', ['as' => 'courierMap', 'uses' => 'SendMapGroup\CourierMapController@index']);

Route::get('/searchFirst/{id?}/{token?}', 'SendMapGroup\SearchFirstController@searchFirst');

Route::get('/searchAdmin/{id?}', 'SendMapGroup\SearchAdminController@searchAdmin');

Auth::routes();


Route::get('logout', function (){
    return view('welcome');
});