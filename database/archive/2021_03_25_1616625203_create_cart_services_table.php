<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartServicesTable extends Migration
{
    public function up()
    {
        Schema::create('cart_services', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('status',1)->default('1');
		$table->string('name',10)->default('');
		$table->string('description',10)->default('');
		$table->float('price');
		$table->string('icon',20)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_services');
    }
}