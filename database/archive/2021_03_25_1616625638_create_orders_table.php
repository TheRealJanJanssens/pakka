<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('name',25)->default('');
		$table->text('note');
		$table->text('instructions');
		$table->integer('financial_status',1)->unsigned()->default('0');
		$table->integer('fulfillment_status',1)->unsigned()->default('0');
		$table->integer('coupon_id',10)->nullable()->default('NULL');
		$table->integer('taxes_included',1)->unsigned()->default('1');
		$table->integer('cancel_reason',1)->unsigned()->default('0');
		$table->timestamp('created_at');
		$table->timestamp('updated_at');
		$table->timestamp('closed_at');
		$table->timestamp('cancelled_at');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}