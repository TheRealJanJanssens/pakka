<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->float('price')->default('0');
		$table->time('duration');
		$table->string('name',20);
		$table->string('description',20);
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}