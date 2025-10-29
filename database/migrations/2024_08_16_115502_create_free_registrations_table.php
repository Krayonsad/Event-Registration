<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable();
            $table->string('prefix')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('governmentId')->nullable();  
            $table->string('identification')->nullable();
            $table->string('passport')->nullable();
            $table->string('adhaarCard')->nullable();
            $table->string('front_photo')->nullable();
            $table->string('organisation')->nullable();
            $table->string('designation')->nullable();
            $table->string('contentPrefix')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('profile')->nullable();
            $table->string('depart')->nullable();
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
        Schema::dropIfExists('free_registrations');
    }
}
