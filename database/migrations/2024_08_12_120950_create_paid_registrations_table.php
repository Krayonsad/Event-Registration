<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_registrations', function (Blueprint $table) {
            $table->id();
            $table->text('participant')->nullable();
            $table->text('order_id')->nullable();
            $table->text('participant_type')->nullable();
            $table->text('core_sector')->nullable();
            $table->text('sponsorship')->nullable();
            $table->text('country')->nullable();
            $table->text('address')->nullable();
            $table->text('countryArea')->nullable();
            $table->text('prefix')->nullable();
            $table->text('passport')->nullable();
            $table->text('firstname')->nullable();
            $table->text('lastname')->nullable();
            $table->text('email')->nullable();;
            $table->text('governmentId')->nullable();
            $table->text('identification')->nullable();
            $table->text('uploaddocument')->nullable();
            $table->text('adhaarCard')->nullable();
            $table->text('uidai')->nullable();
            $table->text('organisation')->nullable();
            $table->text('designation')->nullable();
            $table->text('contentPrefix')->nullable();
            $table->text('contact')->nullable();
            $table->text('telephone')->nullable();
            $table->integer('paymentStatus')->default(0);
            $table->text('icgh_code')->default(0);
            $table->text('industry')->nullable();
            $table->text('academic')->nullable();
            $table->text('profile')->nullable();
            $table->text('government')->nullable();
            $table->text('depart')->nullable();
            $table->text('state', 55)->nullable();
            $table->integer('application_status')->default(0);
            $table->integer('emailStatus')->nullable();
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
        Schema::dropIfExists('paid_registrations');
    }
}
