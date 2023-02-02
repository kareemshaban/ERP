<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
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
            $table->string('sale_status');
            $table->string('payment_status');
            $table->integer('created_by');
            $table->integer('pos');
            $table->double('lista');
            $table->double('profit');
            $table->double('additional_service') -> default(0);
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
        Schema::dropIfExists('sales');
    }
}
