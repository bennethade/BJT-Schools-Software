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
        if (!Schema::hasTable('ptc_general_comments')) {
            Schema::create('ptc_general_comments', function (Blueprint $table) {
                $table->id(); 
                $table->integer('class_id')->nullable();
                $table->integer('exam_id')->nullable();
                $table->integer('student_id')->nullable();
                $table->text('teacher_comment')->nullable();
                $table->text('parent_comment')->nullable();
                $table->integer('created_by')->nullable();
                $table->timestamps();
                $table->integer('updated_by')->nullable();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            $table->dropColumn(['teacher_comment', 'parent_comment']);
        });
    }
};
