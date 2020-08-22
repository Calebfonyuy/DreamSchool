<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('academic_year');
            $table->integer('registration');
            $table->integer('fee_amount');
            $table->integer('pta_levy');
            $table->integer('saved_by');
            $table->integer('statut')->default(1);
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('school_classes');
            $table->foreign('academic_year')->references('id')->on('academic_years');
            $table->foreign('saved_by')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_fees');
    }
}
