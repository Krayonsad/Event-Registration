<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStage2FieldsInHacakthonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hackathon_registrations', function (Blueprint $table) {
            $table->text('stage_2_description')->after('area')->nullable();
            $table->text('stage_2_document')->after('stage_2_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hacakthon', function (Blueprint $table) {
            //
        });
    }
}
