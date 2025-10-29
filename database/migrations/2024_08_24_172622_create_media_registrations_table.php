<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_registrations', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("designation")->nullable();
            $table->string("company_name")->nullable();
            $table->string("mobile_number")->nullable();
            $table->string("email")->nullable();
            $table->string("organization_id")->nullable();
            $table->string("national_identification")->nullable();
            $table->string("passport_no")->nullable();
            $table->string("governmentId")->nullable();
            $table->string("adhar_uid")->nullable();
            $table->string("uploaddocument")->nullable();
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
        Schema::dropIfExists('media_registrations');
    }
}
