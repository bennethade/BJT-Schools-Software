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
        Schema::create('extra_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->string('outstanding')->nullable();
            $table->string('tuition_fee')->nullable();
            $table->string('resources')->nullable();
            $table->string('after_school_care')->nullable();
            $table->string('uniform')->nullable();
            $table->string('club')->nullable();
            $table->string('school_lunch')->nullable();
            $table->string('school_bus')->nullable();
            $table->string('end_of_session')->nullable();
            $table->string('miscellaneous')->nullable();
            $table->string('subtotal')->nullable();
            $table->integer('discount')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_fees');
    }
};
