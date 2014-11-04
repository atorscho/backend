<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('handle')->unique();
		});

		Schema::create('group_permission', function ( Blueprint $table )
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->integer('permission_id')->unsigned();

			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
		});

		Schema::create('permission_user', function ( Blueprint $table )
		{
			$table->increments('id');
			$table->integer('permission_id')->unsigned();
			$table->integer('user_id')->unsigned();

			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
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
		Schema::drop('permission_user');
		Schema::drop('group_permission');
		Schema::drop('permissions');
	}

}
