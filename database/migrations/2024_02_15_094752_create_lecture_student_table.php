<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecture_student', function (Blueprint $table) {
            $table->foreignId('lecture_id');
            $table->foreignId('student_id');
            $table->integer('Status');
            $table->string('note',100);
            $table->string('date');
            $table->timestamps();
            $table->unique(['lecture_id','student_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture_student');
    }
};
