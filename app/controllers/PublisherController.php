<?php

class PublisherController extends BaseController{

	public function index(){
		$total = 0;
		$user = User::where('id','=',Auth::id())->first();
		$views = Viewz::where('user_id','=',Auth::id())->get();
		foreach($views as $count){
			$total = $count->views + $total;
		}
		$user->views = $total;
		$user->save();

		for($i = 0; $i < 7; $i++){
			$date[$i] = date("Y-m-d",strtotime("-$i day"));
			$vpd[$i] = Viewz::where('user_id','=',Auth::id())
					->where('date','=',$date[$i])
					->get();
		}			

		//return $vpd;
		return View::make('publishers.index')->with('user',$user)
				->with('vpd',$vpd)
				->with('date',$date);
	}

	public function documentation(){
		$user = User::find(Auth::id());
		return View::make('publishers.documentation')->with('user',$user);
	}

	public function profile($username){
		$user = User::where('username','=',$username);
		if($user->count()){
			$user = $user->first();

			return View::make('publishers.profile')
					->with('user', $user);
		}
		return App::abort(404);
	}

	public function changePassword($username){

		$rules = array(
			'current-password' => 'required',
			'new-password' => 'required',
			'confirm-password' => 'required|same:new-password'
			);

		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		$user = User::where('username','=',$username)->first();
		
		if(Hash::check(Input::get('current-password'),$user->getAuthPassword())){
			$user->password = Hash::make(Input::get('new-password'));
			$user->save();
			Session::flash('success', 'Password successfully updated.');
			return Redirect::back();
		}else{
			Session::flash('error', 'Current password mismatch!');
			return Redirect::back();
		}	
	}

	public function postApps(){
		$apps = Application::create([
			'title' => Input::get('title'),
			'app_id' => Input::get('appid'),
			'app_key' => Input::get('appkey'),
			'category' => Input::get('category'),
			'user_id' => Auth::id()
			]);
		if($apps)
			return Redirect::route('apps-detail',Input::get('appid'));
	}

	public function getApps(){
		$user = User::find(Auth::id());
		$data = Application::where('user_id','=',Auth::id())->get();
		return View::make('publishers.application')->with('data',$data)->with('user',$user);
	}

	public function appsDetail($appId){
		$user = User::find(Auth::id());
		$apps = Application::where('app_id','=',$appId)->first();
		return View::make('publishers.apps-detail')->with('apps',$apps)->with('user',$user);
	}

	public function appsDelete($id){
		$ads = Application::find($id);
		if($ads->delete()){
			return Redirect::route('publisher-getApps');
		}
	}

	public function postSearch(){
		//return Input::all();
		$keyword = Input::get('search');
		$result = Application::where('title','LIKE','%'.$keyword.'%')->where('user_id','=',Auth::id())->get();
		if($result->count()){
			return Redirect::route('publisher-getApps')->with('result',$result);
		}else{
			return Redirect::route('publisher-getApps')->with('no-result','No match found.');
		}
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('home')
				->with('global','You are logged out.');	
	}

}