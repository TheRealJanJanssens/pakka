<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('status',1)->default('0');
		$table->integer('position',3)->nullable()->default('NULL');
		$table->string('slug',191)->nullable()->default('NULL');
		$table->string('name',191)->nullable()->default('NULL');
		$table->string('template',191)->nullable()->default('NULL');
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->integer('created_by',4)->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->integer('updated_by',4)->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}