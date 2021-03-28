<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionConditionsTable extends Migration
{
    public function up()
    {
        Schema::create('collection_conditions', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('collection_id',10)->unsigned();
		$table->string('input')->default('');
		$table->string('operator',10)->default('');
		$table->string('string')->default('');
		$table->datetime('created_at');
		$table->string('created_by')->default('');
		$table->datetime('updated_at');
		$table->string('updated_by')->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('collection_conditions');
    }
}