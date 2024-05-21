<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuingTable extends Migration
{
    public function up()
    { 
        Schema::create('queuing', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('priority_num'); // Add priority_num field
            
            $table->unsignedBigInteger('studtrans_id');
            $table->foreign('studtrans_id')->references('id')->on('studtrans')->onDelete('cascade');
            $table->unsignedBigInteger('guest_id');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queuing');
    }
}