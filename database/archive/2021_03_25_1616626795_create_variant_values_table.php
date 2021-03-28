<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantValuesTable extends Migration
{
    public function up()
    {
        Schema::create('variant_values', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('variant_id',11)->unsigned();
		$table->string('product_id',25)->default('');
		$table->integer('option_id',11)->unsigned();
		$table->integer('stock_id',11);
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('variant_values');
    }
}