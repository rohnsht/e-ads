<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index(){

		$randomAds = Advertisement::orderBy(DB::raw('RAND()'))->take(8)->get();
		$popularAds = Advertisement::all();
		return View::make('cover')->with(['randAds'=>$randomAds,'popAds'=>$popularAds]);
	}

	public function getLogin(){
		if(Request::ajax())
			return View::make('login');
		else
			return View::make('simple-login');
	}

	public function postLogin(){

		if (! User::loginValid(Input::all())){
			return Response::json([
				'valid' => 'false',
				'errors' => User::$errors->toArray()
			]);
		}
		$remember = (Input::get('remember') == "remember") ? true : false;
		$auth = Auth::attempt(array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			'active' => 1
			),$remember);
		if($auth && Auth::user()->role == "publisher"){	
			if(Request::ajax()){
				$link = route('publisher-dashboard');
				return Response::json(['role'=>'publisher','route'=>$link]);
			}else{
				return Redirect::intended('/publisher');
			}
		}
		elseif($auth && Auth::user()->role == "advertiser"){	
			if(Request::ajax()){
				$link = route('advertiser-dashboard');
				return Response::json(['role'=>'advertiser','route'=>$link]);
			}else{
				return Redirect::intended('/advertiser');
			}
		}
		else{
			return Response::json(['role'=>'none']);
		}
	}	

	public function getRegister(){
		if(Request::ajax())
			return View::make('register');
		else
			return View::make('simple-register');
	}

	public function postRegister(){	

		if(! User::regValid(Input::all())){
			return Response::json(['success'=>false, 'errors'=>User::$errors->toArray()]);
		}

		$username = Input::get('username');
		$password = Hash::make(Input::get('password'));
		$email = Input::get('email');
		$role = Input::get('account');
		$code = str_random(60);

		$user = User::create([
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'role' => $role,
			'code' => $code,
			'active' => 0
			]);

		if($user){

			Mail::send('emails.auth.activate', array('link'=>URL::route('activate',$code),'username'=>$username), function($message) use($user){
				$message->to($user->email,$user->username)->subject('Activate your account');
			});
			Session::flash('global','You have successfully registered.
			An email has been sent to your account. Please activate your account before you login.');
			if(Request::ajax()){
				$link = route('home');
				return Response::json(['success'=>true,'route'=>$link]);
			}else{
				return Redirect::route('home');
			}
		}
			
	}

	public function getActivate($code){
		$user = User::where('code','=',$code)->where('active','=',0);
		if($user->count()){
			$user = $user->first();

			/*update users table*/
			$user->code = null;
			$user->active = 1;
			if($user->save()){
				return Redirect::route('home')
						->with('global','You have successfully activated your account');
			}
		}
		return Redirect::route('home')
				->with('global', 'We could not activate your account. Try again later!');
	}

	public function postForgotPassword(){
		$validator = Validator::make(Input::all(),array(
			'email' => 'required|email|exists:users,email'
			));
		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$user = User::where('email','=',Input::get('email'));
			if($user->count()){
				$user = $user->first();
				$code = str_random(20);

				$user->code = $code;
				if($user->save()){
					Mail::send('emails.auth.recover', array('link'=>URL::route('recover',$code),'username'=>$user->username),function($message) use($user){
						$message->to($user->email,$user->username)->subject('Reset your password');
					});
					return Redirect::back()
					->with('message','An email has been sent to you. Check your email and follow the instructions to reset your password.');
				}
			}	
		}
	}

	public function getForgotPassword(){
		return View::make('password-recover');
	}

	public function getRecover($code){

		$user = User::where('code','=',$code)->get();
		if($user->count()){
			$user = $user->first();
			return View::make('password-change')->with('user',$user);
		}else{
			App::abort(403, 'Unauthorized action.');
		}	
	}

	public function postRecover(){

		$validator = Validator::make(Input::all(),array(
			'password' => 'required|min:4',
			'password-again' => 'required|same:password'
			));
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}else{
			$user = User::where('username','=',Input::get('username'));
			if($user->count()){
				$user = $user->first();

				$user->password = Hash::make(Input::get('password'));
				$user->code = "";
				if($user->save()){
					return Redirect::route('home')
							->with('global','You have successfully created your new password.');
				}
			}
		}
	}

	public function getCategoryType($type){
		$data = Advertisement::where('category','=',$type)->get();
		//return $data;
		return View::make('category')->with('data',$data);
	}

}
