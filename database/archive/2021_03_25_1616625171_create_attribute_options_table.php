<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_options', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('input_id',10)->nullable()->default('NULL');
		$table->string('option_id',10)->nullable()->default('NULL');
		$table->string('language_code',25)->nullable()->default('NULL');
		$table->string('value')->nullable()->default('NULL');
		$table->integer('position',3)->unsigned();
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_options');
    }
}