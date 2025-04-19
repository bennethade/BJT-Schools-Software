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
        Schema::create('cbt_assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cbt_exam_id')->constrained('cbt_exams')->onDelete('cascade'); // Inline foreign key definition
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade'); // Inline foreign key definition
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');   // Inline foreign key definition
            $table->boolean('status');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');   // Inline foreign key definition
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbt_assigns');
    }
};
