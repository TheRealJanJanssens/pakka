<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('name',191);
		$table->string('email',191);
		$table->timestamp('email_verified_at')->nullable()->default('NULL');
		$table->string('password',191);
		$table->string('avatar',191)->nullable()->default('NULL');
		$table->integer('role',11)->default('0');
		$table->text('bio');
		$table->string('remember_token',100)->nullable()->default('NULL');
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}