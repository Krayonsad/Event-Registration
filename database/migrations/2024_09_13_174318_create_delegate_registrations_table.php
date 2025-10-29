<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delegate_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country')->nullable();
            $table->string('prefix', 10)->nullable();
            $table->string('first_name', 255);
            $table->string('last_name', 255)->nullable();
            $table->string('email', 255);
            $table->string('phonecode', 10)->nullable();
            $table->string('contact_no', 20);
            $table->string('organization', 255)->nullable();
            $table->string('designation', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('identification', 100)->nullable(); 
            $table->string('identification_file', 255)->nullable();
            $table->string('passport_no', 255)->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('dob')->nullable();
            $table->enum('visa_invitation', ['Yes', 'No'])->nullable();
            $table->string('transaction_no', 100)->nullable();
            $table->decimal('amount', 10, 2)->nullable()->default(0.00);
            $table->string('payment_mode', 50)->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');

            $table->timestamps();

            // $table->foreign('country')->references('id')->on('countries')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delegate_registrations');
    }
};
