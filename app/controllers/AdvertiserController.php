<?php

class AdvertiserController extends BaseController{

	public function index(){
		/* for calculating no of views */
		$total = 0;
		$views = Advertisement::where('user_id','=',Auth::id())
					->with(array('views'=>function($q){
						$q->where('payment_advertiser','=',0);
					}))->get();
		
		foreach ($views as $view) {
			
			$count = $view->views;	
			if(!empty($count)){
				foreach($count as $count){
					$count = $count->views;
					$total = $total + $count;
				}
			}
		}
		/* end */
		$data = User::find(Auth::id());
		$data->views = $total;
		$data->save();
		
		$views = Advertisement::where('user_id','=',Auth::id())
					->where('deletion','=',0)
					->with(array('views'=>function($q){
						$q->where('payment_advertiser','=',0);
					}))->get();

		for($i = 0; $i < 7; $i++){
			$date[$i] = date("Y-m-d",strtotime("-$i day"));
			$vpd[$i] = Viewz::where('date','=', $date[$i])
						->whereHas('ads',function($q){
            				$q->where('user_id','=',Auth::id());
        				})->get();
		}

		//return $vpd[0][0]->date;
		return View::make('advertisers.index')->with(['data'=>$data,'views'=>$views,'vpd'=>$vpd, 'date'=>$date]);
	}

	public function postAds(){
		$validator = Validator::make(Input::all(),
			array(
				'title' => 'required|alpha_num|max:70',
				'file' => 'required|image|max:2000'
				));
		if($validator->fails()){
			if(Request::ajax())
				return Response::json(['success'=>false,'errors'=>$validator->errors()->toArray()]);
			else
				return Redirect::back()->withErrors($validator);
		}else{
			$file = Input::file('file');
			$ext = $file->getClientOriginalExtension();
			$fileName = str_random(10).".".$ext;
			$imageUrl = 'image/uploads/'.$fileName;
			$img = Image::make($file)->resize(600,600);

			$upload_success = $img->save(public_path($imageUrl));
			if($upload_success){
				Advertisement::create([
					'title' => Input::get('title'),
					'ads' => $imageUrl,
					'category' => Input::get('category'),
					'user_id' => Auth::id(),
					'activation' => 1,
					'price_advertiser' => 2.0,
					'price_publisher' => 1.0
					]);
				$link = route('advertiser-dashboard');
				if(Request::ajax())
					return Response::json(['success'=>true, 'route'=>$link]);
				else
					return Redirect::route('advertiser-dashboard');
			}
		}
	}

	public function getAds(){
		$data = User::find(Auth::id());
		return View::make('advertisers.advertisement')->with('data',$data);
	}

	public function adsUpdate($adsId){
		$ads = Advertisement::find($adsId);
		if($ads->activation == 1){
			$ads->activation = 0;
		}elseif($ads->activation == 0){
			$ads->activation = 1;
		}
		$ads->save();
		return Redirect::route('advertiser-dashboard');
	}

	public function adsDelete($adsId){
		$ads = Advertisement::find($adsId);
		$ads->deletion = 1;
		if($ads->save()){
			return Redirect::route('advertiser-dashboard');
		}
	}

	public function profile($username){
		$user = User::where('username','=',$username)->first();
		return View::make('advertisers.profile')->with("user",$user);
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

	public function postSearch(){
		//return Input::all();
		$keyword = Input::get('search');
		$result = Advertisement::where('user_id','=',Auth::id())->where('title','LIKE','%'.$keyword.'%')->get();
		if($result->count()){
			return Redirect::route('advertiser-dashboard')->with('result',$result);
		}else{
			return Redirect::route('advertiser-dashboard')->with('no-result',"No match found.");
		}
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('home')
				->with('global','You are logged out');
	}

}
	