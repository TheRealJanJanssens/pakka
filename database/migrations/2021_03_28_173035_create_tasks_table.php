<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('assigned_to');
            $table->unsignedInteger('position');
            $table->unsignedInteger('status')->default(0);
            $table->string('name', 191);
            $table->longText('description');
            $table->integer('priority');
            $table->string('tags', 191);
            $table->timestamp('finished_at')->nullable();
            $table->integer('finished_by');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('created_by');
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
