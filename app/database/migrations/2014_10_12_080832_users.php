<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table){
			$table->increments('id');

	        $table->string('username', 20);
	        $table->string('password', 70);
	        $table->string('email', 70);
	        $table->string('fb_user', 70);
	        $table->string('remember_token', 100);
	        $table->string('code');
	        $table->string('role', 20);
	        $table->string('access_token');

	        $table->integer('views');
	        $table->integer('active');

	        $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
