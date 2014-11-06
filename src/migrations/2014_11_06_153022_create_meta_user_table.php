<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetaUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meta_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('meta_id')->unsigned();
			$table->integer('user_id')->unsigned();

			$table->foreign('meta_id')->references('id')->on('usermeta');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meta_user');
	}

}
