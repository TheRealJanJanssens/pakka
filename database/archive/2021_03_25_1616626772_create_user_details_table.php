<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('user_id',10)->unsigned();
		$table->string('firstname')->default('');
		$table->string('lastname')->default('');
		$table->string('address')->default('');
		$table->string('city')->default('');
		$table->string('zip')->default('');
		$table->string('country')->default('');
		$table->string('phone')->default('');
		$table->string('company_name')->default('');
		$table->string('vat')->default('');
		$table->integer('terms_consent',11)->default('0');
		$table->integer('marketing_consent',11)->default('0');
		$table->datetime('birthday')->nullable()->default('NULL');
		$table->datetime('created_at');
		$table->datetime('updated_at');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}