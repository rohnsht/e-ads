<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	if(Auth::check()){
     	$cookieName=Auth::getRecallerName(); //Get the name of the cookie, where remember me expiration time is stored
      	$cookieVal=Cookie::get($cookieName); //Get the value of the cookie
      	return $response->withCookie(Cookie::make($cookieName,$cookieVal,10080)); //change the expiration time
  	}	
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest(URL::route('home'));
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/publisher');
});

Route::filter('advertiser', function()
{
	if (Auth::user()->role=="publisher"){
		return Redirect::to('/publisher');
	}
	
	elseif(Auth::user()->role=="admin"){
		return Redirect::to('/admin/home');
	}
	
});

Route::filter('publisher', function()
{
	if(Auth::user()->role=="advertiser"){
		return Redirect::to('/advertiser');	
	}

	elseif(Auth::user()->role=="admin"){
		return Redirect::to('/admin/home');
	}
});

/*Route::filter('admin', function()
{
	if(Auth::user()->role=="user"){
		return Redirect::to('/user');
	}
	elseif(Auth::user()->role=="advertiser"){
		return Redirect::to('/advertiser');
	}
});*/


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
	if (Session::token() !== $token)
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
