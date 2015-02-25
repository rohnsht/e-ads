<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Viewz extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	protected $fillable = array('ads_id','user_id','views','date','ip','hits','payment_advertiser');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'views';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at','updated_at');

	public function users(){
		return $this->belongsTo('User');
	}

	public function ads(){
		return $this->belongsTo('Advertisement','ads_id','id');
	}
}