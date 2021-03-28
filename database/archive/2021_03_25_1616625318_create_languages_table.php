<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('language_code',25)->default('');
		$table->string('name',25)->default('');
		$table->primary('id');

        });

        DB::table('languages')->insert(
            array(
                'language_code' => 'nl',
                'name' => 'Nederlands'
            )
        );
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
}