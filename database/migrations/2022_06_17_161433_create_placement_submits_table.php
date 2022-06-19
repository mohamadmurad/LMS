<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_submits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id');
            $table->foreign('student_id')
                ->on('users')
                ->references('id')
                ->onDelete('cascade');;

            $table->foreignId('placement_id');
            $table->foreign('placement_id')
                ->on('placements')
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
        Schema::dropIfExists('placement_submits');
    }
}
