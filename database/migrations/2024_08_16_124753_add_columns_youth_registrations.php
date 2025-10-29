<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsYouthRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('youth_registrations', function (Blueprint $table) {
            $table->string('institute')->after('adhaarCard')->nullable();
            $table->string('uploadstudentid')->after('institute')->nullable();
            $table->string('qualification')->after('uploadstudentid')->nullable();
            $table->string('dob')->after('qualification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
