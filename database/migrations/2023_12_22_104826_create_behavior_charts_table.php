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
        Schema::create('behavior_charts', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('student_id')->nullable();

            // $table->integer('number_of_times_present')->nullable();
            // $table->integer('number_of_times_absent')->nullable();
            $table->longText('class_tutor_comment')->nullable();
            $table->longText('head_teacher_remark')->nullable();
            
            
            $table->string('generosity')->nullable();
            $table->string('punctuality')->nullable();
            $table->string('class_attendance')->nullable();
            $table->string('responsibility_in_assignments')->nullable();
            $table->string('attentiveness')->nullable();
            $table->string('initiative')->nullable();
            $table->string('neatness')->nullable();
            $table->string('self_control')->nullable();
            $table->string('relationship_with_staff')->nullable();
            $table->string('relationship_with_students')->nullable();
            $table->string('merits')->nullable();
            $table->string('demerits_detention')->nullable();


            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('behavior_charts');
    }
};
