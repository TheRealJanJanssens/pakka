<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('group_id',10)->unsigned();
		$table->integer('project_id',10)->unsigned();
		$table->integer('assigned_to',10)->unsigned();
		$table->integer('position',4)->unsigned();
		$table->integer('status',1)->unsigned()->default('0');
		$table->string('name',191);
		;
		$table->integer('priority',1);
		$table->string('tags',191);
		$table->timestamp('finished_at')->nullable()->default('NULL');
		$table->integer('finished_by',10);
		$table->timestamp('created_at')->nullable()->default('CURRENT_TIMESTAMP');
		$table->integer('created_by',10);
		$table->timestamp('updated_at')->nullable()->default('CURRENT_TIMESTAMP');
		$table->integer('updated_by',10);
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}