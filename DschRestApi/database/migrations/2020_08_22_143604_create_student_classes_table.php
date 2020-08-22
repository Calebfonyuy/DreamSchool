<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('academic_year');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->boolean('repeater');
            $table->integer('status')->default(1);
            $table->integer('saved_by');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('academic_year')->references('id')->on('academic_years');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('class_id')->references('id')->on('school_classes');
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
        Schema::dropIfExists('student_classes');
    }
}
