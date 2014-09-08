<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array(
	'uses' => 'HomeController@home',
    'as' => 'home'
));

Route::get('/customer', array(
	'uses' => 'HomeController@showCustomer',
    'as' => 'customer-show'
));

Route::get('/parcels', array(
	'uses' => 'HomeController@showParcels',
    'as' => 'parcels-show'
));

Route::get('/parcels/create', array(
	'uses' => 'HomeController@createParcelForm',
    'as' => 'parcel-create'
));

Route::post('/parcels/create', array(
	'uses' => 'HomeController@createParcel',
    'as' => 'parcel-create-post'
));

Route::get('/parcels/pay/{id}', array(
	'uses' => 'HomeController@payParcel',
    'as' => 'parcel-pay'
));

Route::get('/parcels/cancel/{id}', array(
	'uses' => 'HomeController@cancelParcel',
    'as' => 'parcel-cancel'
));
