<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInPaidRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paid_registrations', function (Blueprint $table) {
            $table->text('institute')->after('designation')->nullable();
            $table->text('uploadstudentid')->after('institute')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paid_registrations', function (Blueprint $table) {
            //
        });
    }
}
