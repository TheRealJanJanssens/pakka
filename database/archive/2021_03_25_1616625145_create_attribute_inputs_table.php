<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateAttributeInputsTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_inputs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('input_id',10)->nullable()->default('NULL');
			$table->string('set_id',10)->nullable()->default('NULL');
			$table->integer('position')->default('2');
			$table->char('label',30)->nullable()->default('NULL');
			$table->string('name')->default('');
			$table->string('type',10)->nullable()->default('NULL');
			$table->timestamp('created_at')->nullable()->default(Carbon::now());
			$table->timestamp('updated_at')->nullable()->default(Carbon::now());
			$table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_inputs');
    }
}