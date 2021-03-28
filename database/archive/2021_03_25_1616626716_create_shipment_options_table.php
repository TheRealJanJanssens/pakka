<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_options', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('status',1)->default('1');
		$table->string('name',10)->default('');
		$table->string('description',10)->default('');
		$table->float('price');
		$table->integer('carrier',2);
		$table->integer('delivery',1);
		$table->string('region',2)->default('');
		$table->integer('match',1)->default('1');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_options');
    }
}