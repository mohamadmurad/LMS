<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSubmitAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_submit_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_submits_id');
            $table->foreign('exam_submits_id')
                ->on('exam_submits')
                ->references('id')
                ->onDelete('cascade');


            $table->foreignId('question_id');
            $table->foreign('question_id')
                ->on('questions')
                ->references('id')->onDelete('cascade');


            $table->foreignId('option_id');
            $table->foreign('option_id')
                ->on('question_options')
                ->references('id')->onDelete('cascade');

            $table->boolean('correct')->default(false);


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
        Schema::dropIfExists('exam_submit_answers');
    }
}
