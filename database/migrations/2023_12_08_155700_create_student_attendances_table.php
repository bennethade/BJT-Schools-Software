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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->date('attendance_date')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('attendance_type')->nullable()->comment('1=Present, 2=Late, 3=Absent, 4=Half Day');
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
