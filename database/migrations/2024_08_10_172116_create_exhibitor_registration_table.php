<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitorRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitor_registration', function (Blueprint $table) {
            $table->id();
            $table->text('country')->nullable();
            $table->text('organisation')->nullable();
            $table->text('designation')->nullable();
            $table->text('seatSelect')->nullable();
            $table->text('aboutOrganization')->nullable();
            $table->text('prefix')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('email')->unique();
            $table->text('national_identification')->nullable();
            $table->text('passport_no')->nullable();
            $table->text('governmentId')->nullable();
            $table->text('adhar_uid', 16)->nullable();
            $table->text('teammate_full_name')->nullable();
            $table->text('teammate_email')->nullable();
            $table->text('teammate_national_identification')->nullable();
            $table->text('teammate_passport_no')->nullable();
            $table->text('country_code')->nullable();
            $table->text('contact_no')->nullable();
            $table->text('telephone')->nullable();
            $table->text('address')->nullable();
            $table->text('companyLogo')->nullable();
            $table->text('profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibitor_registration');
    }
}
