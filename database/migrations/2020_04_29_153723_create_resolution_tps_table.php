<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolutionTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolution_tps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('mark')->nullable($value = true);
            $table->unsignedBigInteger('tp_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('tp_id')->references('id')->on('tps');
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
        Schema::dropIfExists('resolution_tps');
    }
}
