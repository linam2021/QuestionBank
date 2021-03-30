<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_question', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');
            $table->text('answer_a');
            $table->text('answer_b');
            $table->text('answer_c');
            $table->text('correct_answer');
            $table->integer('user_id');
            $table->integer('video_number');
            $table->integer('qestion_level');
            $table->integer('course_id');
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
        Schema::dropIfExists('primary_question');
    }
}
