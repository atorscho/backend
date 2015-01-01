<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('content_type_id')->unsigned();
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
			$table->timestamps();

			$table->foreign('content_type_id')->references('id')->on('content_types')->onDelete('cascade');
		});

		Schema::create('contents', function ( Blueprint $table )
		{
			$table->integer('content_type_id')->unsigned();
			$table->integer('field_id')->unsigned();
			$table->text('value')->nullable();

			$table->foreign('content_type_id')->references('id')->on('content_types')->onDelete('cascade');
			$table->foreign('field_id')->references('id')->on('content_fields')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contents');
		Schema::drop('content_fields');
	}

}
