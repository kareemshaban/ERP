<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('invoice_no');
            $table->integer('customer_id');
            $table->integer('biller_id');
            $table->integer('warehouse_id');
            $table->text('note');
            $table->double('total');
            $table->double('discount');
            $table->double('tax');
            $table->double('net');
            $table->double('paid');
            $table->string('purchase_status');
            $table->string('payment_status');
            $table->integer('created_by');
            $table->integer('returned_bill_id') ->default(0) ->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
