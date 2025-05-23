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
        Schema::create('nursery_mid_term_goal_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('exam_id');
            $table->integer('student_id');
            $table->integer('subject_id');
            $table->integer('category_id');
            $table->string('learning_outcome');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nursery_mid_term_goal_registers');
    }
};
