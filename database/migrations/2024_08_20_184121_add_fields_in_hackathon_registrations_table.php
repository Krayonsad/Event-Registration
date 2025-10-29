<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInHackathonRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hackathon_registrations', function (Blueprint $table) {
            $table->text('proposer_prefix')->after('area')->nullable();
            $table->text('proposer_first_name')->after('proposer_prefix')->nullable();
            $table->text('proposer_last_name')->after('proposer_first_name')->nullable();
            $table->text('proposer_organisation')->after('proposer_last_name')->nullable();
            $table->text('proposer_email')->after('proposer_organisation')->nullable();
            $table->text('proposer_contact_no')->after('proposer_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hackathon_registrations', function (Blueprint $table) {
            //
        });
    }
}
