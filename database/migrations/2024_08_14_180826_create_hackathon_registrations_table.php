<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHackathonRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hackathon_registrations', function (Blueprint $table) {
            $table->id();
            $table->text('prefix')->nullable();
            $table->text('first_name')->nullable();
            $table->text('designation')->nullable();
            $table->text('organisation')->nullable();
            $table->text('email')->nullable();
            $table->text('contact_no')->nullable();
            $table->text('abstract')->nullable();
            $table->text('area')->nullable();
            $table->text('prefix1')->nullable();
            $table->text('first_name1')->nullable();
            $table->text('last_name1')->nullable();
            $table->text('organisation1')->nullable();
            $table->text('email1')->nullable();
            $table->text('contact_no1')->nullable();
            $table->text('prefix2')->nullable();
            $table->text('first_name2')->nullable();
            $table->text('last_name2')->nullable();
            $table->text('organisation2')->nullable();
            $table->text('email2')->nullable();
            $table->text('contact_no2')->nullable();
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
        Schema::dropIfExists('hackathon_registrations');
    }
}
