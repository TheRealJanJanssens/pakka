<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(1);
            $table->string('name', 10)->default('');
            $table->string('description', 10)->default('');
            $table->float('price', 10, 0);
            $table->integer('carrier');
            $table->integer('delivery');
            $table->string('region', 2)->default('');
            $table->integer('match')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_options');
    }
}
