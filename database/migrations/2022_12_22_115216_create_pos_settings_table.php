<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_settings', function (Blueprint $table) {
            $table->id();
            $table->string('show_items') -> nullable();
            $table->integer('default_category') -> default(0) -> nullable();
            $table->integer('cashier_id') -> default(0) -> nullable();
            $table->integer('client_id') -> default(0) -> nullable();
            $table->integer('show_time') -> default(0) -> nullable();
            $table->string('item_search') -> nullable();
            $table->string('add_new_item') -> nullable();
            $table->string('insert_client') -> nullable();
            $table->string('add_client') -> nullable();
            $table->string('category_toggle') -> nullable();
            $table->string('subCategory_toggle') -> nullable();
            $table->string('brand_toggle') -> nullable();
            $table->string('cancel_sell') -> nullable();
            $table->string('pend_sell') -> nullable();
            $table->string('printed_material') -> nullable();
            $table->string('finish_bill') -> nullable();
            $table->string('daily_sales') -> nullable();
            $table->string('opening_pending_sales') -> nullable();
            $table->string('close_shift') -> nullable();
            $table->integer('qr_print')  -> default(0) -> nullable();
            $table->integer('header_print') -> default(0) -> nullable();
            $table->string('header_img') -> nullable();
            $table->integer('seller_buyer')  -> default(0) -> nullable();
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
        Schema::dropIfExists('pos_settings');
    }
}
