<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('collection_id',10)->unsigned()->nullable()->default('NULL');
		$table->string('name',90)->default('');
		$table->integer('status',1)->default('1');
		$table->string('code',50)->default('');
		$table->float('discount')->nullable()->default('NULL');
		$table->integer('type',1)->default('1');
		$table->integer('is_fixed',1)->default('1');
		$table->datetime('expiry_date');
		$table->datetime('created_at');
		$table->datetime('updated_at');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}