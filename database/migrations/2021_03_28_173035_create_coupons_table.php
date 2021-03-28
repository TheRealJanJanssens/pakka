<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('collection_id')->nullable();
            $table->string('name', 90)->default('');
            $table->integer('status')->default(1);
            $table->string('code', 50)->default('');
            $table->float('discount', 10, 0)->unsigned()->nullable();
            $table->integer('type')->default(1);
            $table->integer('is_fixed')->default(1);
            $table->dateTime('expiry_date');
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
        Schema::dropIfExists('coupons');
    }
}
