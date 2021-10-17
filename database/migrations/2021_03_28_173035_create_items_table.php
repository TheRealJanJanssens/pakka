<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('id', 25)->default('')->unique('item_id');
            $table->integer('module_id');
            $table->string('slug', 91)->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->string('updated_by', 91)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
