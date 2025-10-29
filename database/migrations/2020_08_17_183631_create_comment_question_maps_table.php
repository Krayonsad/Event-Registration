<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentQuestionMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_question_maps', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
			$table->integer('type_id');
			$table->integer('type')->comment('1:Comment, 2:Question');
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
        Schema::dropIfExists('comment_question_maps');
    }
}
