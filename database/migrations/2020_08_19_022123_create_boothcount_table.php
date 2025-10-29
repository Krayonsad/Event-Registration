<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothcountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boothcount', function (Blueprint $table) {
            $table->id();
            $table->String('name')->nullable();
            $table->integer('booth1')->default(0);
            $table->integer('booth2')->default(0);
            $table->integer('booth3')->default(0);
            $table->integer('booth4')->default(0);
            $table->integer('booth5')->default(0);
            $table->integer('booth6')->default(0);
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
        Schema::dropIfExists('boothcount');
    }
}
