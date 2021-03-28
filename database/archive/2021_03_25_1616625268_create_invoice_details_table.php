<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('invoice_id',25)->default('');
		$table->string('client_name')->default('');
		$table->string('client_address')->default('');
		$table->string('client_city')->default('');
		$table->string('client_zip')->default('');
		$table->string('client_country')->default('');
		$table->string('client_vat')->default('');
		$table->string('client_email')->default('');
		$table->string('client_phone')->default('');
		$table->string('ship_name')->default('');
		$table->string('ship_address')->default('');
		$table->string('ship_city')->default('');
		$table->string('ship_zip')->default('');
		$table->string('ship_country')->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}