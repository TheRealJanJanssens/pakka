<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('task_groups', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('project_id',10)->unsigned();
		$table->string('name',191)->default('');
		$table->integer('position',4)->unsigned();
		$table->string('color',20)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('task_groups');
    }
}