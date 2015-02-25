<?php

class FacebookController extends BaseController{

	public function getLogin(){
		$facebook = new Facebook(Config::get('facebook'));
	    $params = array(
	        'redirect_uri' => url('/login/fb/callback'),
	        'scope' => 'email',
	    );
	    return Redirect::to($facebook->getLoginUrl($params));
	}

	public function getLoginCallback(){
		$code = Input::get('code');

	    if (strlen($code) == 0) 
	    	return Redirect::to('/')->with('global', 'There was an error communicating with Facebook');

	    $facebook = new Facebook(Config::get('facebook'));
	    $uid = $facebook->getUser();
	    
	    if ($uid == 0) 
	    	return Redirect::to('/')->with('global', 'There was an error');

	    $fbData = $facebook->api('/me');
	  	
	  	$user = User::where('fb_user','=',$uid)->first();

	  	if(!$user){
	    	return View::make('fb-login')->with('fbData',$fbData);
	    }
	    
    	$user->access_token = $facebook->getAccessToken();
    	$user->save();

    	$auth = Auth::login($user);


    	if($auth && Auth::user()->role == 'publisher'){
    		return Redirect::intended('publisher');
   		}else if($auth && Auth::user()->role == 'advertiser'){
   			return Redirect::intended('advertiser');
   		}else{
   			return Redirect::route('home')->with('global','Login Unsuccessful.');
   		}
	    
	}

	public function postLogin(){
		$rules = array(
			'username' => 'required|unique:users',
			'account' => 'required|in:publisher,advertiser'
			);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		$users = User::create([
				'username' => Input::get('username'),
				'role' => Input::get('account'),
				'fb_user' => Input::get('fb_user'),
				'email' => Input::get('email')
				]);
		if($users){
			return Redirect::to('login/fb');
		}
	}

}