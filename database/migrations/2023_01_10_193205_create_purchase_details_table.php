<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->string('product_code');
            $table->integer('product_id');
            $table->double('quantity');
            $table->double('cost_without_tax');
            $table->double('cost_with_tax');
            $table->double('warehouse_id');
            $table->double('unit_id');
            $table->double('tax');
            $table->double('total');
            $table->double('net');
            $table->double('returned_qnt') -> nullable() ->default(0);
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
        Schema::dropIfExists('purchase_details');
    }
}
