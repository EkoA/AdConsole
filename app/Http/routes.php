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
//routes created by me
//whatever is outside required the token guard

//API routes
//Route::get();
Route::get('/API/getads/', [
	'uses' => 'APIController@getads',
	'as' => 'api.getads'
]);

Route::put('/API/reportads/{id}', [
	'uses' => 'APIController@reportads',
	'as' => 'api.reportads'
]);

//General Routes
Route::post('/post-test', 'TestController@receiveTest')->name('post.test_page');
Route::post('/responses/', [
	'uses' => 'UserController@responses',
	'as' => 'users.responses'
]);

//this is the start of all the uris that uses the csrf token
Route::group(['middleware' => 'csrf'], function (){
	//route to handle user wallet
	Route::get('/wallet/', [
		'uses' => 'UserController@wallet',
		'as' => 'users.wallet'
	]);

	//route to handle funding of wallet
	Route::post('/fundwallet/', [
		'uses' => 'UserController@fundwallet',
		'as' => 'users.fundwallet'
	]);

	Route::get('/test-page', 'TestController@showPg')->name('get.test_page');


	Route::group(['middleware' => ['nocsrf']], function()
	{

		/**/
	});

	//route to handle responses from Gtpay
	//ads route
	//for testing Ads
	Route::get('/ads/testing/', [
		'uses' => 'AdController@testing',
		'as' => 'ads.testing'
	]);

	Route::put('/ads/report/{id}', [
		'uses' => 'AdController@report',
		'as' => 'ads.report'
	]);

	Route::get('/ads/search/', [
	'uses' => 'AdController@search',
	'as' => 'ads.search'
	]);

	//admins routes
	Route::get('/admins/login/', [
		'uses' => 'AdminController@login',
		'as' => 'admins.login'
	]);

	Route::get('/admins/newads/', [
		'uses' => 'AdminController@newads',
		'as' => 'admins.newads'
	]);

	Route::get('/admins/flagged/', [
		'uses' => 'AdminController@flag',
		'as' => 'admins.flag'
	]);

	Route::get('/admins/settings/', [
		'uses' => 'AdminController@settings',
		'as' => 'admins.settings'
	]);

	Route::put('/admins/addecision/{id}', [
		'uses' => 'AdminController@addescision',
		'as' => 'admins.addecision'
	]);

	//to handle settings
		Route::put('/settings/update', [
			'uses' => 'AdminController@settingsstore',
			'as' => 'settings.store'
		]);

	//default routes

	/*Route::get('/', function () {
	    return view('home');
	});*/

	Route::get('/', [
		'uses' => 'HomeController@index',
		'as' => 'home'
	]);

	Route::auth();

	Route::resource('/ads', 'AdController');

	Route::resource('/admins', 'AdminController');

	Route::get('/home', 'HomeController@index');
});//end of csrf token guard
