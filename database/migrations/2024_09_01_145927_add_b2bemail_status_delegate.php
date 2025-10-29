<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddB2bemailStatusDelegate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paid_registrations', function (Blueprint $table) {
            $table->integer('b2bemail_status')->default(0)->after('emailStatus'); // Add the new column with default value 0
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
            $table->dropColumn('b2bemail_status'); // Reverse the change by dropping the column
        });
    }
}
