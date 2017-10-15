<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
          $table->increments('ca_id');
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
        Schema::dropIfExists('category');
    }
}
