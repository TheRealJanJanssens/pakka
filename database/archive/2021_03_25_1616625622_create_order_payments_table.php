<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('order_id',10)->unsigned();
		$table->string('payment_id',25)->default('');
		$table->string('provider',25)->default('');
		$table->float('amount');
		$table->string('method',50)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_payments');
    }
}