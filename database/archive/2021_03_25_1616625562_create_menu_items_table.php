<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('menu',10)->nullable()->default('NULL');
		$table->integer('parent',10)->nullable()->default('NULL');
		$table->integer('position',3)->nullable()->default('NULL');
		$table->string('icon',191)->nullable()->default('NULL');
		$table->string('name',191)->nullable()->default('NULL');
		$table->string('link',191)->nullable()->default('NULL');
		$table->string('parameter',191)->nullable()->default('NULL');
		$table->string('parameter_slug',191)->nullable()->default('NULL');
		$table->integer('permission',2)->default('1');
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}