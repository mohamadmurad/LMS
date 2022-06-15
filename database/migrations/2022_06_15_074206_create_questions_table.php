<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');

            $table->foreignId('objective_id');
            $table->foreign('objective_id')
                ->on('objectives')
                ->references('id')
                ->onDelete('cascade');

            $table->foreignId('subject_id');
            $table->foreign('subject_id')
                ->on('subjects')
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
        Schema::dropIfExists('questions');
    }
}
