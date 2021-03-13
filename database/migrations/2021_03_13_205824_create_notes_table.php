<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) 
        {
            $table->uuid('id')->primary();

            $table->uuid('course_id');

            $table->foreign('course_id')->references('id')->on('courses');

            $table->uuid('subject_id');

            $table->foreign('subject_id')->references('id')->on('subjects');

            $table->uuid('student_id');

            $table->foreign('student_id')->references('id')->on('students');

            $table->uuid('period_id');

            $table->foreign('period_id')->references('id')->on('periods');
            
            $table->string('note');

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
        Schema::dropIfExists('notes');
    }
}
