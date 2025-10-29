<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsStage2FieldsInHacakthonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hackathon_registrations', function (Blueprint $table) {
            $table->integer('is_stage_2')->after('stage_2_document')->default(0);
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
