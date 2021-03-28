<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {

		$table->string('id',10)->default('');
		$table->integer('page_id',10)->unsigned();
		$table->integer('section_id',10)->unsigned();
		$table->integer('position',10)->unsigned();
		$table->string('slug',191)->default('');
		$table->string('name',191)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('components');
    }
}