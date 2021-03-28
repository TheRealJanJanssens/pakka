<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {

		$table->string('id',25)->default('');
		$table->string('invoice_no',25)->nullable()->default('NULL');
		$table->integer('status',11)->nullable()->default('NULL');
		$table->integer('type',11)->nullable()->default('NULL');
		$table->integer('client_id',10)->unsigned();
		$table->datetime('date')->nullable()->default('NULL');
		$table->datetime('due_date')->nullable()->default('NULL');
		$table->text('description');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->string('created_by')->nullable()->default('NULL');
		$table->datetime('sended_at')->nullable()->default('NULL');
		$table->string('sended_to')->nullable()->default('NULL');
		$table->datetime('received_at')->nullable()->default('NULL');
		$table->datetime('canceled_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}