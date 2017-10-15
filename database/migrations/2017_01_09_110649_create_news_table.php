<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('title_sid');
			$table->integer('content_sid');
			$table->integer('category_id');
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
		Schema::drop('news');
	}

}
