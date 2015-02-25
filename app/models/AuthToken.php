<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AuthToken extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	protected $fillable = array('app_id','auth_tokens','ip');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'auth-tokens';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at','updated_at');

	public function apps(){
		return $this->belongsTo('Application');
	}
}