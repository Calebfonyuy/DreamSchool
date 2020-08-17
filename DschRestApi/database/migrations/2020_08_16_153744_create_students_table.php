<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission_number',100)->unique();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->date('date_of_birth');
            $table->enum('gender',['M','F']);
            $table->string('address',100);
            $table->string('email',100)->nullable();
            $table->string('contact',100)->nullable();
            $table->string('father_name',100)->nullable();
            $table->string('father_address',100)->nullable();
            $table->string('father_contact',50)->nullable();
            $table->string('father_mail',50)->nullable();
            $table->string('mother_name',100)->nullable();
            $table->string('mother_address',100)->nullable();
            $table->string('mother_contact',50)->nullable();
            $table->string('mother_mail',50)->nullable();
            $table->string('previous_school',100)->nullable();
            $table->string('faith',50)->nullable();
            $table->text('medical_information')->nullable();
            $table->text('picture')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}
