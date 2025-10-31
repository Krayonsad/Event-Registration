<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tech_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->string('contact_country_code', 10);
            $table->string('contact_number', 20);
            $table->string('address_line');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode');
            $table->string('company_name');
            $table->string('designation')->nullable();
            $table->string('industry')->nullable();
            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tech_registrations');
    }
};
