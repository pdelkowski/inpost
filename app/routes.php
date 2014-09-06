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

Route::get('/', function()
{
	return View::make('home');
});

Route::get('/hello', function()
{
	return View::make('hello');
});

Route::get('/service', function() {
	echo '<pre>';
	echo "<h1>Checking DDD architecture</h1>";
	//return InpostApi::getInpostApi();
	$api = InpostApi::getInpostApi();
	echo $api->getPackages();
	echo $api->getPresenter()->presentUrl();
	echo '<br>';
	$api->extend('Entities\InpostApiEntity');
	$api->print_hello();
	die;
});
