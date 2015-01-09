<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxonomiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taxonomies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type_id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->string('title');
			$table->string('slug')->unique();
			$table->integer('order');

			$table->foreign('type_id')->references('id')->on('taxonomy_types')->onDelete('cascade');
			$table->foreign('parent_id')->references('id')->on('taxonomies')->onDelete('cascade');
		});

		Schema::create('content_taxonomies', function(Blueprint $table)
		{
			$table->integer('content_id')->unsigned();
			$table->integer('taxonomy_id')->unsigned();

			$table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
			$table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('content_taxonomies');
		Schema::drop('taxonomies');
	}

}
