<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateQuntityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_quntity_details', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->integer('update_qnt_id');
            $table->integer('item_id');
            $table->integer('type');
            $table->integer('qnt');
            $table->string('notes');
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
        Schema::dropIfExists('update_quntity_details');
    }
}
