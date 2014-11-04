<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('handle')->unique();
			$table->string('prefix')->nullable();
			$table->string('suffix')->nullable();
		});

		Schema::create('group_user', function ( Blueprint $table )
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->integer('user_id')->unsigned();

			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_user');
		Schema::drop('groups');
	}

}
