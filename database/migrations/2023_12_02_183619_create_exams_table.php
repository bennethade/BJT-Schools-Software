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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('session')->nullable();
            $table->longText('note')->nullable();
            $table->integer('no_of_times_school_opened')->nullable();
            $table->string('school_stamp')->nullable();
            $table->date('this_term_commenced')->nullable();
            $table->date('this_term_ends')->nullable();
            $table->date('next_term_begins')->nullable();
            $table->integer('jss1_number')->nullable();
            $table->integer('jss2_number')->nullable();
            $table->integer('jss3_number')->nullable();
            $table->integer('sss1_number')->nullable();
            $table->integer('sss2_number')->nullable();
            $table->integer('sss3_number')->nullable();
            $table->integer('grade1_number')->nullable();
            $table->integer('grade2_number')->nullable();
            $table->integer('grade3_number')->nullable();
            $table->integer('grade4_number')->nullable();
            $table->integer('grade5_number')->nullable();
            $table->integer('grade6_number')->nullable();

            $table->integer('explorer2_number')->nullable();
            $table->integer('explorer1_number')->nullable();
            $table->integer('pre_nursery_number')->nullable();
            $table->integer('play_pen_number')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('is_delete')->default(0)->nullable()->comment('0:not deleted, 1:deleted');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
