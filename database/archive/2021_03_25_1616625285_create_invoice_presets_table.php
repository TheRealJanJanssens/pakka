<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePresetsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_presets', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('name')->default('');
		$table->float('price')->nullable()->default('NULL');
		$table->float('quantity')->nullable()->default('NULL');
		$table->integer('vat',10)->default('0');
		$table->integer('position',10);
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_presets');
    }
}