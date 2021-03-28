<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('order_documents', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('order_id',10)->unsigned();
		$table->string('document_id',25)->default('');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_documents');
    }
}