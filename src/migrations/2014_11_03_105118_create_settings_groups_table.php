<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings_groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('handle')->unique();
		});

		Schema::table('settings', function (Blueprint $table)
		{
			$table->foreign('settings_group_id')->references('id')->on('settings_groups')->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('settings', function ( Blueprint $table )
		{
			$table->dropForeign('settings_settings_group_foreign');
		});

		Schema::drop('settings_groups');
	}

}
