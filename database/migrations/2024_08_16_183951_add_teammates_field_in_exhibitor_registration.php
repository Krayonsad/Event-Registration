<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeammatesFieldInExhibitorRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exhibitor_registration', function (Blueprint $table) {
            $table->text('teammate_document')->after('teammate_passport_no')->nullable();
            $table->text('teammate_phone_number')->after('teammate_document')->nullable();
            $table->text('uploaddocument')->after('adhar_uid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exhibitor_registration', function (Blueprint $table) {
            //
        });
    }
}
