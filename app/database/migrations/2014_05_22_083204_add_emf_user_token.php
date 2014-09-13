<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmfUserToken extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('users', function($table)
        {
            $table->integer('emf_user_id')->nullable()->default(null);
            $table->string('emf_token', 40)->nullable()->default(null);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function($table)
        {
            $table->dropColumn('emf_token');
            $table->dropColumn('emf_user_id');
        });
	}

}
