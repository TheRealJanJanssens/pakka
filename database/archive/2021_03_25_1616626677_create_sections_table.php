<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('page_id',10)->unsigned();
		$table->integer('position',3)->unsigned();
		$table->integer('status',1)->unsigned()->default('1');
		$table->string('type',191);
		$table->string('name',191);
		$table->integer('section',20)->nullable()->default('NULL');
		$table->string('classes',750)->default('');
		$table->string('attributes',750)->default('');
		$table->string('extras',750)->default('');
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
}