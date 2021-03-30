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
            $table->text('question_text')->unique();
            $table->text('answer_a');
            $table->text('answer_b');
            $table->text('answer_c');
            $table->enum('correct_answer',['a','b','c']);
            $table->integer('user_id');
            $table->integer('video_number');
            $table->enum('question_level',['normal','hard']);
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
