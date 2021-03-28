<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('status',1)->unsigned()->default('0');
		$table->integer('position',3)->unsigned();
		$table->string('name',100);
		$table->string('description',100);
		$table->string('slug',100)->default('');
		$table->string('sort_order',100);
		$table->integer('type',1)->unsigned();
		$table->integer('match',1)->unsigned()->nullable()->default('NULL');
		$table->datetime('created_at');
		$table->string('created_by')->default('');
		$table->datetime('updated_at');
		$table->string('updated_by')->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('collections');
    }
}