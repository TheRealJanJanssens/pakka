<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentConditionsTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_conditions', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('shipment_option_id',10)->unsigned();
		$table->integer('operator',1)->unsigned()->default('1');
		$table->float('value');
		$table->integer('type',1)->unsigned()->default('1');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_conditions');
    }
}