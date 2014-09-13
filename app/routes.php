<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(['before' => 'localization'], function() {

	Route::get('/', array('as' => 'home', function() {
		return View::make('realhome');
	}));


	//localization route
	Route::get('/login', array(function() {
		return Redirect::to(Config::get('kuu.default_locale').'/login');
	}));

    Route::get('/home', array(function() {
        return Redirect::route('realhome', array('lang' =>App::getLocale()));
    }));

});
Route::group(['prefix' => '{lang}', 'before' => 'localization'], function() {
    Route::get('/home', array('as' => 'realhome', function() {
        return View::make('home');
    }));


    // Session Routes
	Route::resource('/sessions', 'SessionController', array('only' => array('create', 'store', 'destroy')));
	Route::get('/logout', array('as' => 'logout', 'uses' => 'SessionController@destroy'));
	Route::get('/login',  array('as' => 'login', 'uses' => 'SessionController@create'));

	// User Routes
	Route::get('register', array('as' => 'register', 'uses' => 'UserController@create'));
	Route::get('users/{id}/activate/{code}', 'UserController@activate')->where('id', '[0-9]+');
	Route::get('resend', array('as' => 'resendActivationForm', function() {
		return View::make('users.resend');
	}));
	Route::post('resend', 'UserController@resend');
	Route::get('forgot', array('as' => 'forgotPasswordForm', function() {
		return View::make('users.forgot');
	}));

	Route::post('forgot', 'UserController@forgot');
    /*
	Route::post('users/{id}/change', 'UserController@change');
	Route::get('users/{id}/reset/{code}', 'UserController@reset')->where('id', '[0-9]+');
	Route::get('users/{id}/suspend', array('as' => 'suspendUserForm', function($id) {
		return View::make('users.suspend')->with('id', $id);
	}));
	Route::post('users/{id}/suspend', 'UserController@suspend')->where('id', '[0-9]+');
	Route::get('users/{id}/unsuspend', 'UserController@unsuspend')->where('id', '[0-9]+');
	Route::get('users/{id}/ban', 'UserController@ban')->where('id', '[0-9]+');
	Route::get('users/{id}/unban', 'UserController@unban')->where('id', '[0-9]+');
*/
	Route::resource('users', 'UserController', array('names' => array('create' => 'users.create', 'store' => 'users.store')));

	// Group Routes
	Route::resource('groups', 'GroupController');

	Route::get('/dashboard', array('as' => 'dashboard', function(){
		if(!is_null(Sentry::getUser())) {
			return Redirect::route('dashboard_ws_email', array('lang' =>App::getLocale(), 'email' => Sentry::getUser()->email));
		}
		else
			return Redirect::route('login', array('lang' =>App::getLocale()));
	}));
	Route::get('/dashboard/{email}', array('as' => 'dashboard_ws_email','uses' => 'DashboardController@index'));
	Route::get('/walkthrough', array('as' => 'walkthrough', 'uses' => 'DashboardController@walkthrough'));

	Route::post('/contacts/send', array('as' => 'contacts.send', 'uses' => 'ContactsController@send'));

	Route::get('/privacy-policy', array('as' => 'privacy-policy', function() {
		return View::make('privacy-policy');
	}));

	Route::get('/terms-of-use', array('as' => 'terms-of-use', function() {
		return View::make('terms-of-use');
	}));

	Route::get('/account', array('as' => 'account', 'uses' => 'UserController@accountpage'));
	Route::post('/accountupdate-personal', array('as' => 'accountupdate-personal', 'uses' => 'UserController@accountpageupdate_personal'));
	Route::post('/accountupdate-password', array('as' => 'accountupdate-password', 'uses' => 'UserController@accountpageupdate_password'));

	Route::post('/addaccountalertemail', array('as' => 'addaccountalertemail', 'uses' => 'UserController@addAccountAlertEmail'));
	Route::post('/deleteaccountalertemail', array('as' => 'deleteaccountalertemail', 'uses' => 'UserController@deleteAccountAlertEmail'));
	Route::post('/sendconfirmaccountalertemail', array('as' => 'sendconfirmaccountalertemail', 'uses' => 'UserController@sendConfirmAccountAlertEmail'));

	Route::post('/checksite/addsiteinfohttp', array('as' => 'checksite.addsiteinfohttp', 'uses' => 'CheckSiteController@postAddSiteInfoHTTP'));
	Route::post('/checksite/addsiteinfohttps', array('as' => 'checksite.addsiteinfohttps', 'uses' => 'CheckSiteController@postAddSiteInfoHTTPS'));
	Route::post('/checksite/addsiteinfodns', array('as' => 'checksite.addsiteinfodns', 'uses' => 'CheckSiteController@postAddSiteInfoDNS'));
	Route::post('checksite/addsiteinfoauto',array('as'=>'checksite.addsiteinfoauto','uses'=>'CheckSiteController@postAddSiteInfoAuto'));
	Route::post('/checksite/deletecheck',array('as'=>'checksite.deletecheck','uses'=>'CheckSiteController@deleteCheck'));
	Route::post('/checksite/suspendcheck',array('as'=>'checksite.suspendcheck','uses'=>'CheckSiteController@suspendCheck'));
	Route::post('/checksite/refresh',array('as'=>'checksite.refresh','uses'=>'CheckSiteController@refresh'));
	Route::get('/checksite/testsiteinfo',array('as'=>'checksite.testsiteinfo','uses'=>'CheckSiteController@testsiteinfo'));
	Route::get('/alerts/{id}/activate/{code}', 'UserController@activateAlertEmail')->where('id', '[0-9]+');

	Route::post('/getgraphdata', array('as' => 'getgraphdata', 'uses' => 'DashboardController@getGraphData'));
	Route::post('/getgraphdatawalkthrough', array('as' => 'getgraphdatawalkthrough', 'uses' => 'DashboardController@getGraphDataWalkthrough'));
	Route::post('/getsiteinfoforedit', array('as' => 'getsiteinfoforedit', 'uses' => 'CheckSiteController@getSiteInfo'));

	Route::post('/edithttpsiteinfoforedit', array('as' => 'edithttpsiteinfoforedit', 'uses' => 'CheckSiteController@editHTTPSiteInfo'));
	Route::post('/edithttpssiteinfoforedit', array('as' => 'edithttpssiteinfoforedit', 'uses' => 'CheckSiteController@editHTTPSSiteInfo'));
	Route::post('/editdnssiteinfoforedit', array('as' => 'editdnssiteinfoforedit', 'uses' => 'CheckSiteController@editDNSSiteInfo'));

	Route::get('/contact-support', array('as' => 'contact-support', 'uses' => 'ContactsController@contactSupport'));
	Route::get('/contact-support/check/{id}', 'ContactsController@contactSupportForCheck')->where('id', '[0-9]+');

	Route::group(array('before' => 'admin'), function() {

		Route::group(array('before' => 'admin'), function() {

			//Route::resource('/admin/check/{user_id}/','AdminCheckController');
			Route::get('/admin/check/{user_id}/{check_id}/edit', array('as' => 'admin.check.edit', 'uses' => 'AdminCheckController@edit'));
			Route::put('/admin/check/{user_id}/{check_id}/suspend', array('as' => 'admin.check.suspend', 'uses' => 'AdminCheckController@suspend'));
			Route::put('/admin/check/{user_id}/{check_id}', array('as' => 'admin.check.update', 'uses' => 'AdminCheckController@update'));
			Route::delete('/admin/check/{user_id}/{check_id}', array('as' => 'admin.check.delete', 'uses' => 'AdminCheckController@destroy'));
			Route::get('/admin/check/{user_id}/create', array('as' => 'admin.check.create', 'uses' => 'AdminCheckController@create'));
			Route::post('/admin/check/{user_id}', array('as' => 'admin.check.store', 'uses' => 'AdminCheckController@store'));
			Route::get('/admin/check/{user_id}', array('as' => 'admin.check.user', 'uses' => 'AdminCheckController@index'));
			Route::get('/admin/check', array('as' => 'admin.check', 'uses' => 'AdminCheckController@index'));

			Route::get('/admin/alert/{check_id}', array('as' => 'admin.alert', 'uses' => 'AdminAlertEmailController@index'));
			Route::post('/admin/alert/{check_id}', array('as' => 'admin.alert.store', 'uses' => 'AdminAlertEmailController@store'));
			Route::delete('/admin/alert/{check_id}', array('as' => 'admin.alert.delete', 'uses' => 'AdminAlertEmailController@destroy'));
			Route::put('/admin/alert/{check_id}/{alert_id}', array('as' => 'admin.alert.update', 'uses' => 'AdminAlertEmailController@update'));

			Route::resource('/admin/user', 'AdminUserController', array('names' => array('index' => 'admin.user')));
			Route::get('/admin', array('as' => 'admin', 'uses' =>'AdminUserController@index'));
		});
	});
});

Route::post('/sso-login', array('as' => 'emf_login', 'uses' => 'EmfLoginController@generateToken'));
Route::get('/emf/{token}', array('as' => 'emf_login.login', 'uses' => 'EmfLoginController@loginByToken'));


// function() {
// 	if( !Sentry::check() ) {
// 		return Redirect::to('login');
// 	}
	
// 	return View::make('dashboard.account');
// }

// App::missing(function($exception) {
// 	App::abort(404, 'Page not found');
// 	return Response::view('errors.missing', array(), 404);
// });