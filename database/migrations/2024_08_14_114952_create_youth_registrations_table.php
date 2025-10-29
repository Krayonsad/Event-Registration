<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYouthRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youth_registrations', function (Blueprint $table) {
            $table->id();
            $table->text('country')->nullable();
            $table->text('prefix')->nullable();
            $table->text('firstname')->nullable();
            $table->text('lastname')->nullable();
            $table->text('email')->nullable();
            $table->text('identification')->nullable();
            $table->text('passport')->nullable();
            $table->text('governmentId')->nullable();
            $table->text('adhaarCard')->nullable();
            $table->text('organisation')->nullable();
            $table->text('designation')->nullable();
            $table->text('contentPrefix')->nullable();
            $table->text('contact')->nullable();
            $table->text('telephone')->nullable();
            $table->text('address')->nullable();
            $table->string('uploaddocument')->nullable();
            $table->string('profile')->nullable();
            // $table->timestamps();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youth_registrations');
    }
}
