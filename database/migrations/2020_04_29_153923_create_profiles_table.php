<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img')->nullable($value = true);
            $table->boolean('state')->nullable($value = true);
            $table->string('bio')->nullable($value = true);
            $table->unsignedBigInteger('user_id')->nullable($value = true);
            $table->unsignedBigInteger('teacher_id')->nullable($value = true);
            $table->unsignedBigInteger('admin_id')->nullable($value = true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('profiles');
    }
}
