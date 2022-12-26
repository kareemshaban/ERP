<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateQuntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_quntities', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->dateTime('bill_date') -> nullable();
            $table->string('bill_number');
            $table->integer('warehouse_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('update_quntities');
    }
}
