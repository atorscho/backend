<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptgroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('optgroups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('handle')->unique();
		});

		Schema::table('options', function (Blueprint $table)
		{
			$table->foreign('optgroup_id')->references('id')->on('optgroups')->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('options', function ( Blueprint $table )
		{
			$table->dropForeign('options_optgroup_id_foreign');
		});

		Schema::drop('optgroups');
	}

}
