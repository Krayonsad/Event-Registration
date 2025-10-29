<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConexpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conexpo', function (Blueprint $table) {
            $table->id();
			$table->String('name')->nullable();
			$table->integer('count')->default(0);
			$table->tinyInteger('status')->default(1)->comment('1:Conference, 2:Expo');
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
        Schema::dropIfExists('conexpo');
    }
}
