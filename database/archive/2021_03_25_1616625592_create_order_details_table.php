<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('order_id',10)->unsigned();
		$table->integer('user_id',10)->unsigned();
		$table->string('firstname')->default('');
		$table->string('lastname')->default('');
		$table->string('address')->default('');
		$table->string('city')->default('');
		$table->string('zip')->default('');
		$table->string('country')->default('');
		$table->string('email')->nullable()->default('NULL');
		$table->string('phone')->default('');
		$table->string('company_name')->default('');
		$table->string('vat')->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}