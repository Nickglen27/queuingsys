<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

    class CreateTransactionsTable extends Migration
    {
        public function up()
        {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('department_id')->nullable();
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
                $table->string('transaction_type');
                $table->timestamps();
         });
        }
    
        public function down()
        {
            Schema::dropIfExists('transactions');
        }
    }
