<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->enum('type', ['text', 'email', 'url', 'radio', 'checkbox', 'textarea']);
			$table->string('name');
			$table->string('handle')->unique();
			$table->string('placeholder')->nullable();
			$table->string('description')->nullable();
			$table->boolean('required')->default(0);
			$table->string('min')->nullable();
			$table->string('max')->nullable();
			$table->integer('step')->unsigned()->nullable();
			$table->integer('cols')->unsigned()->nullable();
			$table->integer('rows')->unsigned()->nullable();
			$table->string('pattern')->nullable();
			$table->integer('order')->unsigned();

			$table->foreign('group_id')->references('id')->on('user_field_groups')->onDelete('cascade');
		});

		Schema::create('user_fields_pivot', function ( Blueprint $table )
		{
			$table->integer('field_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('value');

			$table->foreign('field_id')->references('id')->on('user_fields')->onDelete('cascade');
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
		Schema::drop('user_fields_pivot');
		Schema::drop('user_fields');
	}

}
