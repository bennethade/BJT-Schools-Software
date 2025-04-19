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
        Schema::create('assign_students', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->boolean('lock_student')->default(true);
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_students');
    }
};
