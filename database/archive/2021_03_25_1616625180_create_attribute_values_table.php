<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeValuesTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_values', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('input_id',10)->nullable()->default('NULL');
		$table->string('item_id',25)->default('');
		$table->string('language_code',25)->nullable()->default('NULL');
		$table->string('option_id',10)->nullable()->default('NULL');
		$table->text('value');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
}