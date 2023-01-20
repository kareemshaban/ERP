<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_movements', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->double('paid');
            $table->double('credit');
            $table->double('debit');
            $table->string('date');
            $table->string('invoice_type');
            $table->double('invoice_id');
            $table->string('invoice_no');
            $table->string('paid_by');
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
        Schema::dropIfExists('vendor_movements');
    }
}
