<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategory2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category2', function(Blueprint $table)
		{
			$table->integer('ca_id', true);
			$table->integer('parent_id');
			$table->integer('title_sid');
			$table->integer('show_menu');
			$table->integer('active_flag');
			$table->integer('insert_user')->nullable();
			$table->dateTime('insert_date')->nullable();
			$table->integer('update_user')->nullable();
			$table->dateTime('update_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category2');
	}

}
