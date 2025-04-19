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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade'); // Inline foreign key definition
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');   
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('early_bird')->nullable();
            $table->string('neatest_pupil')->nullable();
            $table->string('best_behaved_pupil')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
