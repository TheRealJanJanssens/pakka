<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('service_id',10)->unsigned()->nullable()->default('NULL');
		$table->integer('provider_id',10)->unsigned()->nullable()->default('NULL');
		$table->integer('client_id',10)->unsigned()->nullable()->default('NULL');
		$table->datetime('start_at');
		$table->datetime('end_at')->nullable()->default('NULL');
		$table->string('title')->default('');
		$table->float('price')->default('0');
		$table->string('description',500)->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}