<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('status',1)->unsigned();
		$table->integer('client_id',4)->unsigned();
		$table->string('name',191)->default('');
		$table->text('description');
		$table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
		$table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}