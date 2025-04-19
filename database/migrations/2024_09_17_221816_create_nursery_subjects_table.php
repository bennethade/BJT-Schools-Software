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
        Schema::create('nursery_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('category_id');
            $table->tinyInteger('class_id');
            $table->tinyInteger('exam_id');
            $table->boolean('status')->default(true);
            $table->tinyInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nursery_subjects');
    }
};
