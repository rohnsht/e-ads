<?php

class AdminController extends BaseController{

	public function login(){
		return View::make('admin.login');
	}

	public function postLogin(){
		$rules = array(
			'username' => 'required',
			'password' => 'required');

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::back()
			->withErrors($validator);
		}	
		else{
			if(Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'role' => 'admin'
				))){
				return Redirect::to('admin/home');
			}
			else{
				Session::flash('global', 'Invalid username and password!');
				return Redirect::to('admin/login');
			}
		
		}
	}

	/*public function index(){
		return View::make('admin.home');
	}*/

	public function home(){
		return View::make('admin.home');
	}
	
	public function getAdvertiser(){

		$data = User::where('role','=','advertiser')->get();
		return View::make('admin.advertiser')->with('data',$data);
	}

	public function advertiserContent($id){

		$data = Advertisement::where('user_id','=',$id)->get();
		return View::make('admin.advertiserContent')->with('data',$data);
	}

	public function changeCategory(){

		$data = Advertisement::where('id','=',Input::get('id'))->first();
		$data->category = Input::get('category');
		if($data->save()){
			return Redirect::route('advertiser-content',$data->user_id);
		}
	}

	public function getUser(){

		$data = User::where('role','=','publisher')->get();
		return View::make('admin.publisher')->with('data',$data);
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('home');
	}
}