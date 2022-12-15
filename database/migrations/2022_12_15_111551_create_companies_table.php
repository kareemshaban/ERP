<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('group_id');  // 1 => biller , 2=> customer , 3=> supplier
            $table->string('group_name'); // biller , customer , supplier
            $table->integer('customer_group_id');
            $table->string('customer_group_name');
            $table->string('name');
            $table->string('company');
            $table->string('vat_no');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country');
            $table->string('email');
            $table->string('phone');
            $table->text('invoice_footer')->default('');
            $table->text('logo')->default('');
            $table->double('award_points')->default(0);
            $table->double('deposit_amount')->default(0); //customer or supplier current balance
            $table->double('opening_balance')->default(0);
            $table->integer('account_id')->default(0);
            $table->double('credit_amount')->default(0);
            $table->integer('stop_sale')->default(0); // 1=> stop sale if customer balance reaches credit amount
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
