<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           $table->increments('id');
            $table->String('ContactName')->nullable();
            $table->String('Designation')->nullable();
            $table->string('OfficialEmail',150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->String('mobile')->nullable();
            $table->String('linkedin_link')->nullable();
            $table->String('twitter_link')->nullable();
            $table->String('image')->nullable();
            $table->String('terms')->nullable();
            $table->String('Organisation')->nullable();
            $table->String('State')->nullable();
            $table->String('ZipCode')->nullable();
            $table->String('CompanyAddress')->nullable();
            $table->String('phone')->nullable();
            $table->String('ficci_member')->nullable();
            $table->String('ficci_no')->nullable();
            $table->String('gst')->nullable();
            $table->String('GSTNumber')->nullable();
            $table->String('payment_type')->nullable();
            $table->String('payment_amount')->nullable();
            $table->String('session_id')->nullable();
            $table->String('isLoggedIn')->nullable();
            $table->enum('user_status', array('0','1','2'))->nullable();


            $table->String('google_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
