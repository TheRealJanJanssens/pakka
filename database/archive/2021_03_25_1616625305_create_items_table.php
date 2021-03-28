<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {

		$table->string('id',25)->default('');
		$table->integer('module_id',10);
		$table->string('slug',91)->nullable()->default('NULL');
		$table->integer('status',1)->default('0');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->integer('created_by',4)->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->string('updated_by',91)->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}