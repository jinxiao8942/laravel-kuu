<?php

class SentryUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//DB::table('users')->delete();

		$user = Sentry::getUserProvider()->create(array(
	        'email'    => 'admin@admin.com',
	        'password' => 'KuuAdmin',
	        'activated' => 1,
	    ));

        $adminGroup = Sentry::findGroupByName('Admins');
        $user->addGroup($adminGroup);
/*
	    Sentry::getUserProvider()->create(array(
	        'email'    => 'user@user.com',
	        'password' => 'sentryuser',
	        'activated' => 1,
	    ));
*/
	}

}