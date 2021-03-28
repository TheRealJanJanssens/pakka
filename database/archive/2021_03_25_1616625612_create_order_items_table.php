<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {

		$table->increments('id');
		$table->string('order_id',25)->default('');
		$table->string('product_id',25)->default('');
		$table->string('sku',90)->default('');
		$table->string('name')->nullable()->default('NULL');
		$table->float('price')->default('0');
		$table->float('quantity')->default('0');
		$table->integer('weight',10)->unsigned()->default('0');
		$table->integer('vat',10)->unsigned()->default('0');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}