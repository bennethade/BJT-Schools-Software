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
        Schema::create('marks_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('ca')->nullable();
            // $table->integer('ca2')->default(0);
            // $table->integer('ca3')->default(0);
            $table->integer('exam')->nullable();
            $table->integer('subject_total')->nullable();
            $table->string('teacher_remark')->nullable();
            $table->integer('full_mark')->nullable();
            $table->integer('pass_mark')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks_registers');
    }
};
