<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToMediaRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_registrations', function (Blueprint $table) {
            $table->integer('status')->nullable();
            $table->integer('form_status')->default('0');
        });
    }

    public function down()
    {
        Schema::table('media_registrations', function (Blueprint $table) {
            //
        });
    }
}
