<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('service_assignments', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('service_id',10)->unsigned();
		$table->integer('provider_id',10)->unsigned();
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('service_assignments');
    }
}