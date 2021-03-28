<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionSetsTable extends Migration
{
    public function up()
    {
        Schema::create('collection_sets', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('collection_id',10)->unsigned();
		$table->integer('product_id',10)->unsigned();
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('collection_sets');
    }
}