<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisements', function(Blueprint $table){
			$table->increments('id');

			$table->string('title', 70);
			$table->string('ads', 70);
			$table->string('category', 70);
			$table->string('redirect_url',100);
			$table->string('orientation', 5);
			
			$table->boolean('deletion');
			$table->boolean('activation');
			$table->float('price_advertiser');
			$table->float('price_publisher');
			
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
		Schema::drop('advertisements');
	}

}
