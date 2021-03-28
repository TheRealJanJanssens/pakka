<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('translation_id',11)->default('');
		$table->string('language_code',3)->default('');
		$table->string('input_name');
		$table->text('text');
		$table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
		$table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }
}