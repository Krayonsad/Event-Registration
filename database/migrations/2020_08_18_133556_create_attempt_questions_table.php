<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_questions', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
			$table->integer('question_id');
			$table->integer('answer_id');
			$table->integer('is_correct')->nullable()->comment('1:Correct');
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
        Schema::dropIfExists('attempt_questions');
    }
}
