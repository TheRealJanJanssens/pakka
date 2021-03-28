<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->unsignedInteger('position');
            $table->unsignedInteger('status')->default(1);
            $table->string('type', 191);
            $table->string('name', 191);
            $table->integer('section')->nullable();
            $table->string('classes', 750)->nullable()->default('');
            $table->string('attributes', 750)->nullable()->default('');
            $table->string('extras', 750)->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
