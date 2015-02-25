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

/*Authenticated routes group*/

Route::group(array('before'=>'auth'),function(){


	/*Routes group for admin*/

	Route::group(array('prefix'=>'admin'), function(){

		Route::get('home', array('as'=>'admin-home', 'uses'=>'AdminController@home'));
		Route::get('getadvertiser', array('as'=>'get-advertiser', 'uses'=>'AdminController@getAdvertiser'));
		Route::get('getadvertiser/{id}', array('as'=>'advertiser-content', 'uses'=>'AdminController@advertiserContent'));
		Route::post('getadvertiser/changecategory', array('as'=>'change-category', 'uses'=>'AdminController@changeCategory'));
		Route::get('getuser', array('as'=>'get-user', 'uses'=>'AdminController@getUser'));
		Route::get('logout', array('as'=>'admin-logout', 'uses'=>'AdminController@logout'));

	});


	/* Routes group for publishers */

	Route::group(array('before'=>'publisher'), function(){

		Route::post('publisher/apps', array('as'=>'publisher-postApps', 'uses'=>'PublisherController@postApps'));
		Route::post('publisher/apps/search', array('as'=>'publisher-search', 'uses'=>'PublisherController@postSearch'));
		Route::post('publisher/{username}/edit', array('as'=>'publisher-changePassword', 'uses'=>'PublisherController@changePassword'));

		Route::get('publisher', array('as'=>'publisher-dashboard', 'uses'=>'PublisherController@index'));
		Route::get('publisher/logout', array('as'=>'publisher-logout', 'uses'=>'PublisherController@logout'));
		Route::get('publisher/apps', array('as'=>'publisher-getApps', 'uses'=>'PublisherController@getApps'));
		Route::get('publisher/documentation', array('as'=>'publisher-documentation', 'uses'=>'PublisherController@documentation'));
		Route::get('publisher/{username}', array('as'=>'publisher-profile', 'uses'=>'PublisherController@profile'));
		Route::get('publisher/apps/{appId}', array('as'=>'apps-detail', 'uses'=>'PublisherController@appsDetail'));
		Route::delete('publisher/apps/{appId}', array('as'=>'apps-delete', 'uses'=>'PublisherController@appsDelete'));

	});
	
	/* Routes group for advertisers */

	Route::group(array('before'=>'advertiser'), function(){

		Route::post('advertiser/post-ads', array('before'=>'csrf', 'uses'=>'AdvertiserController@postAds'));
		Route::post('advertiser/search', array('as'=>'advertiser-search', 'uses'=>'AdvertiserController@postSearch'));
		Route::post('advertiser/{username}/edit', array('as'=>'advertiser-changePassword', 'uses'=>'AdvertiserController@changePassword'));

		Route::get('advertiser', array('as'=>'advertiser-dashboard', 'uses'=>'AdvertiserController@index'));
		Route::put('advertiser/ads/{adid}', array('as'=>'advertiser-ads-update', 'uses'=>'AdvertiserController@adsUpdate'));
		Route::delete('advertiser/ads/{adid}', array('as'=>'advertiser-ads-delete', 'uses'=>'AdvertiserController@adsDelete'));
		Route::get('advertiser/post-ads', array('as'=>'advertiser-postAds', 'uses'=>'AdvertiserController@getAds'));
		Route::get('advertiser/logout', array('as'=>'advertiser-logout', 'uses'=>'AdvertiserController@logout'));
		Route::get('advertiser/{username}', array('as'=>'advertiser-profile', 'uses'=>'AdvertiserController@profile'));

	});
	
});


/*UnAuthenticated routes group*/


Route::group(array('before'=>'guest'), function(){

	/*CSRF protection group*/

	Route::group(array('before'=>'csrf'), function(){

		Route::post('register', 'HomeController@postRegister');
		Route::post('login', 'HomeController@postLogin');
		Route::post('login/recover', 'HomeController@postForgotPassword');
		Route::post('recover', 'HomeController@postRecover');
		Route::post('login/fb', 'FacebookController@postLogin');

	});
	
	Route::get('/', array('as'=>'home', 'uses'=>'HomeController@index'));
	Route::get('login', 'HomeController@getLogin');
	Route::get('register', 'HomeController@getRegister');
	Route::get('activate/{code}', array('as'=>'activate', 'uses'=>'HomeController@getActivate'));
	Route::get('login/recover', array('as'=>'forgot-password', 'uses'=>'HomeController@getForgotPassword'));
	Route::get('recover/{code}', array('as'=>'recover','uses'=>'HomeController@getRecover'));
	Route::get('login/fb', array('as'=>'fblogin', 'uses'=>'FacebookController@getLogin'));
	Route::get('login/fb/callback', 'FacebookController@getLoginCallback');

	/*Routes for admin */

	Route::get('admin/login', 'AdminController@login');
	Route::post('admin/login', array('as'=>'admin-login', 'uses'=>'AdminController@postLogin'));

});

/* Routes for Category */

Route::get('category', array('as'=>'category', 'uses'=>'HomeController@getCategory'));
Route::get('category/{type}',array('as'=>'category-type', 'uses'=>'HomeController@getCategoryType'));

/* Routes for Api generation */

Route::get('api','ApiController@errorApi');
Route::get('api/{category}','ApiController@getApi');

/* Routes for collecting views */

Route::post('views','ViewController@getView');
Route::post('auth', 'ViewController@getAuthToken');

/*Routes for paypal payout*/

Route::get('payment', array('as'=>'advertiser-payment','uses'=>'PaypalPaymentController@create'));
Route::get('/payment/confirmpayment','PaypalPaymentController@getConfirmpayment');
Route::get('/payment/cancelpayment','PaypalPaymentController@getCancelpayment');