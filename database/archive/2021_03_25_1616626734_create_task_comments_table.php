<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('task_comments', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('task_id',10)->unsigned();
		$table->integer('user_id',10)->unsigned();
		$table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
		$table->text('text');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('task_comments');
    }
}