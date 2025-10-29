<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlterUsersattedancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//ALTER TABLE `users` ADD `attedances` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '\'0:not attend, 1:attend\'' AFTER `session_id`;
		DB::statement("ALTER TABLE `users` ADD `attedances` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '\'0:not attend, 1:attend\'' AFTER `session_id`");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('alter_usersattedances');
    }
}
