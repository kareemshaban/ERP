<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->string('name');
            $table->integer('unit');
            $table->double('price');
            $table->double('cost');
            $table->double('lista');
            $table->double('alert_quantity');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->double('quantity');
            $table->integer('tax_rate');
            $table->integer('tax_method');
            $table->integer('track_quantity');
            $table->integer('type');
            $table->integer('brand');
            $table->string('slug');
            $table->integer('featured');
            $table->integer('active');
            $table->double('city_tax');
            $table->integer('max_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
