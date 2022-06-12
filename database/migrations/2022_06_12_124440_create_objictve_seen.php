<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjictveSeen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objective_seen', function (Blueprint $table) {

            $table->foreignId('student_id');
            $table->foreign('student_id')
                ->on('users')
                ->references('id');

            $table->foreignId('objective_id');
            $table->foreign('objective_id')
                ->on('objectives')
                ->references('id');

            $table->primary(['objective_id','student_id'],'enroll_student_objective');
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
        Schema::dropIfExists('objictve_seen');
    }
}
