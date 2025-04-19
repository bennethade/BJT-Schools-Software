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
        if (!Schema::hasTable('nursery_subject_comments')) {
            Schema::create('nursery_subject_comments', function (Blueprint $table) {
                // Schema::create('nursery_subject_comments', function (Blueprint $table) {
                $table->id();
                $table->tinyInteger('class_id');
                $table->tinyInteger('exam_id');
                $table->bigInteger('student_id');
                $table->tinyInteger('subject_id');
                $table->text('comment')->nullable();
                $table->integer('created_by')->nullable();
                // $table->integer('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nursery_subject_comments');
    }
};
