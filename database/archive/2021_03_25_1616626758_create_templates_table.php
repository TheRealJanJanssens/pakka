<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('name')->default('');
		$table->string('file')->default('');
		$table->datetime('created_at');
		$table->datetime('updated_at');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('templates');
    }
}