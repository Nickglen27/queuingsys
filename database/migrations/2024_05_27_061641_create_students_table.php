<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('stud_id')->unique(); // Unique identifier for students
            $table->string('Firstname');
            $table->string('Middlename')->nullable(); // Middle name can be nullable
            $table->string('Lastname');
            $table->string('Grade');
            $table->string('Section');
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
        Schema::dropIfExists('students');
    }
}
