<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('head_pic');
            $table->string('user_name');
            $table->string('sex');
            $table->string('birthday');
            $table->string('education');
            $table->string('university');
            $table->string('department');
            $table->string('teaching_school');
            $table->string('course_name');
            $table->string('title');
            $table->string('phone');
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
        Schema::drop('teacher');
    }
}
