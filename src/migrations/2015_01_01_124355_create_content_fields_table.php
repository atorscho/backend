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
			$table->integer('type_id')->unsigned();
			$table->enum('type', ['text', 'email', 'url', 'radio', 'checkbox', 'textarea']);
			$table->string('name');
			$table->string('handle');
			$table->string('placeholder')->nullable();
			$table->string('description')->nullable();
			$table->boolean('required')->default(0);
			$table->string('min')->nullable();
			$table->string('max')->nullable();
			$table->integer('step')->unsigned()->default(1);
			$table->string('pattern')->nullable();
			$table->integer('order')->unsigned();
			$table->timestamps();

			$table->foreign('type_id')->references('id')->on('content_types')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('content_fields');
	}

}
