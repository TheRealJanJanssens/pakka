<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('product_id',25)->default('');
		$table->string('name',90)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('variants');
    }
}