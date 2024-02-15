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
        Schema::create('subject_student', function (Blueprint $table) {
            $table->foreignId('subject_id');
            $table->foreignId('student_id');
            $table->float('mid_mark');
            $table->float('final_mark');
            $table->boolean('passed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher');
    }
};
