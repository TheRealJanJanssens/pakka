<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('product_id',25);
		$table->string('sku',90)->default('');
		$table->float('price');
		$table->integer('quantity',10)->unsigned();
		$table->integer('weight',10)->unsigned();
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}