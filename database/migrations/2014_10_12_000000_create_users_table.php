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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('email')->unique();


            $table->string('user_type')->comment('1:Admin, 2:Teacher, 3:Student, 4:Parent');
            $table->tinyInteger('is_delete')->default(0)->comment('0:not deleted, 1:deleted')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0:active, 1:inactive');
            $table->string('keep_track');

            //Fields for student starts 
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('mobile_number')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('occupation')->nullable();
            $table->string('address')->nullable();
            //Fields for student ends 



            //Fields for Teachers Starts
            $table->string('marital_status')->nullable();
            $table->text('permanent_address')->nullable();
            $table->longText('qualification')->nullable();
            $table->longText('work_experience')->nullable();
            $table->longText('note')->nullable();
            //Fields for Teachers Ends
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
