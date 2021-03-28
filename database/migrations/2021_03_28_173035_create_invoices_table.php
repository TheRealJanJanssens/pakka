<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id', 25)->default('')->unique('id');
            $table->string('invoice_no', 25)->nullable();
            $table->integer('status')->nullable();
            $table->integer('type')->nullable();
            $table->unsignedInteger('client_id');
            $table->dateTime('date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->text('description')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('sended_at')->nullable();
            $table->string('sended_to')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
