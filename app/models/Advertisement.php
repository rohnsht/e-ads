<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Advertisement extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	protected $fillable = array('title','ads','category','user_id','activation','orientation','price_advertiser','price_publisher');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'advertisements';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at','updated_at');

	public function users(){
		return $this->belongsTo('User');
	}

	public function views(){
		return $this->hasMany('Viewz','ads_id','id');
	}
}