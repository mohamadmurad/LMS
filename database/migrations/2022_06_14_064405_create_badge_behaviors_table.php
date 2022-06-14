<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeBehaviorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badge_behaviors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('badge_id');
            $table->foreign('badge_id')
                ->on('badges')
                ->references('id')
                ->onDelete('cascade');


            $table->foreignId('behavior_id');
            $table->foreign('behavior_id')
                ->on('behaviors')
                ->references('id')
                ->onDelete('cascade');


            $table->foreignId('subject_id');
            $table->foreign('subject_id')
                ->on('subjects')
                ->references('id')
                ->onDelete('cascade');

            $table->unique(['subject_id', 'behavior_id', 'badge_id']);
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
        Schema::dropIfExists('badge_behaviors');
    }
}
