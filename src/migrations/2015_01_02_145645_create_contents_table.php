<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type_id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->string('title');
			$table->string('slug')->unique();
			$table->boolean('published')->default(1);
			$table->integer('order')->unsigned()->default(1);
			$table->integer('created_by')->unsigned();
			$table->integer('updated_by')->unsigned();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('type_id')->references('id')->on('content_types')->onDelete('cascade');
			$table->foreign('parent_id')->references('id')->on('contents')->onDelete('cascade');
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
		});

		Schema::create('contents_pivot', function(Blueprint $table)
		{
			$table->integer('content_id')->unsigned();
			$table->integer('field_id')->unsigned();
			$table->text('value');

			$table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
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
		Schema::drop('contents_pivot');
		Schema::drop('contents');
	}

}
