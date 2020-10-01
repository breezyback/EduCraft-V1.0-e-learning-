<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscription_cours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cour_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('cour_id')->references('id')->on('cours');
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
        Schema::dropIfExists('inscription_cours');
    }
}
