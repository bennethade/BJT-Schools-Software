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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('motto')->nullable();
            $table->string('school_address')->nullable();
            $table->string('school_email_1')->nullable();
            $table->string('school_email_2')->nullable();
            $table->string('school_phone_1')->nullable();
            $table->string('school_phone_2')->nullable();
            $table->string('school_website')->nullable();
            $table->string('school_account_name')->nullable();
            $table->string('school_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('accountant_signature')->nullable();
            $table->string('head_of_school_signature')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('barcode')->nullable();
            $table->longText('exam_description')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('favicon_icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('seal')->nullable();
            $table->string('trophy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
