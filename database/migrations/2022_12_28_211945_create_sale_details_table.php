<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->string('product_code');
            $table->integer('product_id');
            $table->double('quantity');
            $table->double('price_without_tax');
            $table->double('price_with_tax');
            $table->double('warehouse_id');
            $table->double('unit_id');
            $table->double('tax');
            $table->double('total');
            $table->double('lista');
            $table->double('profit');


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
        Schema::dropIfExists('sale_details');
    }
}
