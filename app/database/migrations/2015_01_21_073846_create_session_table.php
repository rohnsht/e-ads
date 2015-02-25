<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth-tokens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('app_id')->unsigned();
			$table->foreign('app_id')->references('id')->on('applications')->onDelete('cascade');
			$table->string('auth_tokens',20);
			$table->string('ip',50);
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
		Schema::drop('auth-tokens');
	}

}
