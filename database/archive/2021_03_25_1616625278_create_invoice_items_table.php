<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {

		$table->increments('id');
		$table->string('invoice_id',25)->default('');
		$table->string('name')->nullable()->default('NULL');
		$table->float('price')->default('0');
		$table->float('quantity')->default('0');
		$table->integer('vat',10)->unsigned()->default('0');
		$table->integer('position',10)->unsigned();
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}