<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assignment_id');
            $table->foreign('assignment_id')
                ->on('assignments')
                ->references('id')
                ->onDelete('cascade');


            $table->foreignId('student_id');
            $table->foreign('student_id')
                ->on('users')
                ->references('id')
                ->onDelete('cascade');


            $table->longText('content');
            $table->boolean('status')->default(0); // pending 0 , 1 marked
            $table->unsignedInteger('mark')->default(0);

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
        Schema::dropIfExists('assignment_submits');
    }
}
