<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->string('type');
			$table->string('name');
			$table->string('handle')->unique();
			$table->string('placeholder')->nullable();
			$table->boolean('required')->nullable();
			$table->string('min')->nullable();
			$table->string('max')->nullable();
			$table->integer('step')->unsigned()->nullable();
			$table->integer('maxlength')->nullable();
			$table->string('pattern')->nullable();
			$table->timestamps();

			$table->foreign('group_id')->references('id')->on('field_groups')->onDelete('cascade');
		});

		Schema::create('user_fields', function ( Blueprint $table )
		{
			$table->integer('field_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('value');
			$table->timestamps();

			$table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
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
		Schema::drop('user_fields');
		Schema::drop('fields');
	}

}
