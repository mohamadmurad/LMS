<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsBehaviorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_behaviors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('point_id');
            $table->foreign('point_id')
                ->on('points')
                ->references('id')
                ->onDelete('cascade');

            $table->foreignId('behavior_id');
            $table->foreign('behavior_id')
                ->on('behaviors')
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
        Schema::dropIfExists('points_behaviors');
    }
}
