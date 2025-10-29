<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentdata', function (Blueprint $table) {
            $table->id();
			$table->string('name', 50);
            $table->string('email', 50);
			$table->text('comment');
			$table->integer('parent_id')->nullable();
			$table->tinyInteger('status')->default(1)->comment('1:Active, 2:InActive');
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
        Schema::dropIfExists('commentsdata');
    }
}
