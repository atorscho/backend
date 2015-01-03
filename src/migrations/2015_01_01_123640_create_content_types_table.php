<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('name_sg');
			$table->string('description');
			$table->string('slug')->unique();
			$table->string('icon');
			$table->boolean('hierarchical');
			$table->text('labels');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('content_types');
	}

}
