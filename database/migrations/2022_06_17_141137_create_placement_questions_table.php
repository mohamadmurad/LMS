<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('placement_id');
            $table->foreign('placement_id')
                ->on('placements')
                ->references('id')
                ->onDelete('cascade');


            $table->foreignId('question_id');
            $table->foreign('question_id')
                ->on('questions')
                ->references('id')
                ->onDelete('cascade');

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
        Schema::dropIfExists('placement_questions');
    }
}
