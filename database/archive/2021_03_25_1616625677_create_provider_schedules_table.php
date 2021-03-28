<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('provider_schedules', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('provider_id',10)->unsigned();
		$table->integer('mon',1)->unsigned()->default('0');
		$table->integer('tue',1)->unsigned()->default('0');
		$table->integer('wed',1)->unsigned()->default('0');
		$table->integer('thu',1)->unsigned()->default('0');
		$table->integer('fri',1)->unsigned()->default('0');
		$table->integer('sat',1)->unsigned()->default('0');
		$table->integer('sun',1)->unsigned()->default('0');
		$table->time('start_at');
		$table->time('end_at');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('provider_schedules');
    }
}