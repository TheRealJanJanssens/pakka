<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMigrationsTable extends Migration
{
    public function up()
    {
        Schema::create('migrations', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('migration',191);
		$table->integer('batch',11);
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('migrations');
    }
}