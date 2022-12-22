<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name') -> nullable();
            $table->integer('currency_id') -> default(0) -> nullable();
            $table->string('email') -> nullable();
            $table->integer('client_group_id') -> default(0) -> nullable();
            $table->integer('nom_of_days_to_edit_bill') -> default(0) -> nullable();
            $table->integer('branch_id') -> default(0) -> nullable();
            $table->integer('cashier_id') -> default(0) -> nullable();
            $table->integer('item_tax')-> default(0) -> nullable();
            $table->integer('item_expired')-> default(0) -> nullable();
            $table->decimal('img_width')-> default(0) -> nullable();
            $table->decimal('img_height')-> default(0) -> nullable();
            $table->decimal('small_img_width')-> default(0) -> nullable();
            $table->decimal('small_img_height')-> default(0) -> nullable();
            $table->integer('barcode_break')-> default(0) -> nullable();
            $table->integer('sell_without_stock')-> default(0) -> nullable();
            $table->integer('customize_refNumber')-> default(0) -> nullable();
            $table->integer('item_serial')->default(0) -> nullable();
            $table->integer('adding_item_method')->default(0) -> nullable();
            $table->integer('payment_method')->default(0) -> nullable();
            $table->string('sales_prefix')-> nullable();
            $table->string('sales_return_prefix')-> nullable();
            $table->string('payment_prefix')-> nullable();
            $table->string('purchase_payment_prefix')-> nullable();
            $table->string('deliver_prefix')-> nullable();
            $table->string('purchase_prefix')-> nullable();
            $table->string('purchase_return_prefix')-> nullable();
            $table->string('transaction_prefix')-> nullable();
            $table->string('expenses_prefix')-> nullable();
            $table->string('store_prefix')-> nullable();
            $table->string('quotation_prefix')-> nullable();
            $table->string('update_qnt_prefix')-> nullable();

            $table->integer('fraction_number')->default(0) -> nullable();
            $table->integer('qnt_decimal_point')->default(0) -> nullable();
            $table->integer('decimal_type')->default(0) -> nullable();
            $table->integer('thousand_type')->default(0) -> nullable();
            $table->integer('show_currency')->default(0) -> nullable();
            $table->string('currency_label')-> nullable();
            $table->integer('a4_decimal_point')->default(0) -> nullable();
            $table->integer('barcode_type')->default(0) -> nullable();
            $table->integer('barcode_length')->default(0) -> nullable();
            $table->string('flag_character')-> nullable();
            $table->integer('barcode_start')->default(0) -> nullable();
            $table->integer('code_length')->default(0) -> nullable();
            $table->integer('weight_start')->default(0) -> nullable();
            $table->integer('weight_length')->default(0) -> nullable();
            $table->decimal('weight_divider')->default(0) -> nullable();
            $table->integer('email_protocol')->default(0) -> nullable();
            $table->string('email_host')-> nullable();
            $table->string('email_user')-> nullable();
            $table->string('email_password')-> nullable();
            $table->string('email_port')-> nullable();
            $table->integer('email_encrypt')->default(0) -> nullable();
            $table->string('email_path')-> nullable();


            $table->decimal('client_value')->default(0) -> nullable();
            $table->decimal('client_points')->default(0) -> nullable();
            $table->decimal('employee_value')->default(0) -> nullable();
            $table->decimal('employee_points')->default(0) -> nullable();
            $table->integer('is_tobacco')->default(0) -> nullable();
            $table->decimal('tobacco_tax')->default(0) -> nullable();


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
        Schema::dropIfExists('system_settings');
    }
}
