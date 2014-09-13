<?php

class SentryGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('groups')->delete();

		Sentry::getGroupProvider()->create(array(
	        'name'        => 'Users',
	        'permissions' => array(
	            'admin.users' => 0,
	            'user.interface' => 1,
	        )));

		Sentry::getGroupProvider()->create(array(
	        'name'        => 'Admins',
	        'permissions' => array(
                'admin.users' => 1,
                'user.interface' => 1,
	        )));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'EmfUsers',
            'permissions' => array(
                'admin.users' => 0,
                'user.interface' => 1,
                'emf.login' => 1,
            )));
	}

}