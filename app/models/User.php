<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	protected $fillable = array('username','password','email','role','code','active','fb_user','access_token');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public static $loginRules = array(
		'username' => 'required',
		'password' => 'required'
		);

	public static $regRules = array(
		'username' => 'required|unique:users',
		'password' => 'required|max:20|min:3',
		'password-again' => 'required|same:password',
		'email' => 'required|email|max:70|unique:users',
		'account' => 'required|in:publisher,advertiser'
		);

	public static $errors;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function ads(){
		return $this->hasMany('Advertisement');
	}

	public function apps(){
		return $this->hasMany('Application');
	}

	public function views(){
		return $this->hasMany('Viewz');
	}

	public static function regValid($data){
		$validator = Validator::make($data, static::$regRules);
		if($validator->passes())
			return true;

		static::$errors = $validator->messages();

		return false;
	}

	public static function loginValid($data){
		$validator = Validator::make($data, static::$loginRules);
		if($validator->passes())
			return true;

		static::$errors = $validator->messages();

		return false;
	}

}