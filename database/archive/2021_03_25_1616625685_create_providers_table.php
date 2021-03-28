<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('name',191)->default('');
		$table->integer('user_id',10)->nullable()->default('NULL');
		$table->integer('capacity',5)->default('1');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('providers');
    }
}