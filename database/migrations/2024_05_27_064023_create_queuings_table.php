<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuingsTable extends Migration
{
    public function up()
    {
        Schema::create('queuings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('priority_num');
            $table->unsignedBigInteger('department_id'); // Add department_id column
            $table->unsignedBigInteger('studtrans_id');
            $table->foreign('studtrans_id')->references('id')->on('studtrans')->onDelete('cascade');
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->unsignedBigInteger('windows')->nullable(); // Add windows column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queuings');
    }
}
