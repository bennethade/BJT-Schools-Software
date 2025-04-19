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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->date('homework_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->string('document_file')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('is_delete')->default(0);
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
