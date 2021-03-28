<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('order_shipments', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('order_id',10)->unsigned();
		$table->integer('option_id',10)->unsigned();
		$table->string('option_name')->nullable()->default('NULL');
		$table->integer('carrier',2)->nullable()->default('NULL');
		$table->string('track_code')->nullable()->default('NULL');
		$table->string('weight')->nullable()->default('NULL');
		$table->string('company_name')->nullable()->default('NULL');
		$table->string('firstname')->default('');
		$table->string('lastname')->default('');
		$table->string('address')->default('');
		$table->string('city')->default('');
		$table->string('zip')->default('');
		$table->string('country')->default('');
		$table->string('email')->nullable()->default('NULL');
		$table->string('phone')->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_shipments');
    }
}