<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDocDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_doc_details', function (Blueprint $table) {
            $table->id();
            $table->integer('employer_id');
            $table->double('hours');
            $table->double('hour_value');
            $table->double('reward');
            $table->double('additional');
            $table->double('advance_payment');
            $table->double('deductions');
            $table->integer('salary_doc_id');
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
        Schema::dropIfExists('salary_doc_details');
    }
}
