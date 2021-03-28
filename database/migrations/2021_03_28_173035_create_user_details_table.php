<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('firstname')->nullable()->default('');
            $table->string('lastname')->nullable()->default('');
            $table->string('address')->nullable()->default('');
            $table->string('city')->nullable()->default('');
            $table->string('zip')->nullable()->default('');
            $table->string('country')->nullable()->default('');
            $table->string('phone')->nullable()->default('');
            $table->string('company_name')->nullable()->default('');
            $table->string('vat')->nullable()->default('');
            $table->integer('terms_consent')->default(0);
            $table->integer('marketing_consent')->default(0);
            $table->dateTime('birthday')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
