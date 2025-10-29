<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country')->nullable();
            $table->string('prefix', 10)->nullable();
            $table->string('first_name', 255);
            $table->string('last_name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('participant_type', 100)->nullable();
            $table->string('national_identification', 255)->nullable();
            $table->string('passport_no', 255)->nullable();
            $table->string('visa_facility', 50)->nullable();
            $table->string('governmentId', 255)->nullable(); 
            $table->string('government_id_number', 255)->nullable();
            $table->string('front_photo', 255)->nullable();
            $table->string('back_photo', 255)->nullable();
            $table->string('collage_name', 255)->nullable();
            $table->string('course_pursuing', 255)->nullable();
            $table->string('phonecode', 10)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('profile', 255)->nullable();
            $table->timestamp('emailStatus')->nullable();
            $table->timestamp('entryMailStatus')->nullable();
            $table->string('payment_mode', 50)->nullable();
            $table->string('transaction_no', 100)->nullable();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');

            $table->timestamps();

            // $table->foreign('country')->references('id')->on('countries')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_registrations');
    }
};
