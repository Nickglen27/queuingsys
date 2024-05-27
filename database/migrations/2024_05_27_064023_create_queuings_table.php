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
            // Define the schema for the 'queuings' table
            $table->unsignedBigInteger('priority_num');
            $table->unsignedBigInteger('studtrans_id');
            $table->foreign('studtrans_id')->references('id')->on('studtrans')->onDelete('cascade');
            // $table->unsignedBigInteger('guest_id')->nullable();
            // $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queuings');
    }
}
