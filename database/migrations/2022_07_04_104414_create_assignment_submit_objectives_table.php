<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmitObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submit_objectives', function (Blueprint $table) {
            $table->id();

            $table->foreignId('objective_id');
            $table->foreign('objective_id')
                ->on('objectives')
                ->references('id')
                ->onDelete('cascade');


            $table->foreignId('submit_id');
            $table->foreign('submit_id')
                ->on('assignment_submits')
                ->references('id')
                ->onDelete('cascade');

            $table->boolean('is_achieved')->default(false);

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
        Schema::dropIfExists('assignment_submit_objectives');
    }
}
