<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('variant_options', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('variant_id',11)->unsigned();
		$table->string('product_id',25)->default('');
		$table->string('name',90)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('variant_options');
    }
}