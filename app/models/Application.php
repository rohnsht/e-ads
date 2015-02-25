<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Application extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	protected $fillable = array('title','app_id','app_key','category','user_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'applications';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('id','user_id','created_at','updated_at');

	public function users(){
		return $this->belongsTo('User');
	}

	public function tokens(){
		return $this->hasMany('AuthToken');
	}
}