<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('invoice_id', 25)->default('');
            $table->string('name')->nullable();
            $table->float('price', 10, 0)->nullable()->default(0);
            $table->float('quantity', 10, 0)->nullable()->default(0);
            $table->unsignedInteger('vat')->nullable()->default(0);
            $table->unsignedInteger('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
