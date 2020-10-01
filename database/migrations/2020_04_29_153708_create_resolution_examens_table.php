<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolutionExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolution_examens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('mark')->nullable($value = true);
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('exam_id')->references('id')->on('examens');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('resolution_examens');
    }
}
