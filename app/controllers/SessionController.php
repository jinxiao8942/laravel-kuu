<?php

use Authority\Repo\Session\SessionInterface;
use Authority\Service\Form\Login\LoginForm;

class SessionController extends BaseController {

	/**
	 * Member Vars
	 */
	protected $session;
	protected $loginForm;

	/**
	 * Constructor
	 */
	public function __construct(SessionInterface $session, LoginForm $loginForm)
	{
		$this->session = $session;
		$this->loginForm = $loginForm;
	}

	/**
	 * Show the login form
	 */
	public function create()
	{
        if(Sentry::check())
            return Redirect::route('dashboard',array('lang' =>App::getLocale()));
        else
		    return View::make('sessions.login');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Form Processing
        $result = $this->loginForm->save( Input::all() );

        if( $result['success'] )
        {
            Event::fire('user.login', array(
            							'userId' => $result['sessionData']['userId'],
            							'email' => $result['sessionData']['email']
            							));

            // Success!
            return Redirect::route('dashboard', array('lang' =>App::getLocale()));

        } else {
            if(User::where('email','=',Input::get('email',''))->count()) {
                $check_email = User::where('email','=',Input::get('email',''))->first();
                if($check_email->emf_user_id) {
                    return Redirect::away(Config::get('kuu.emf_login_page'));
                }
            }
            Session::flash('error', $result['message']);
            return Redirect::route('login', array('lang' =>App::getLocale()))
                ->withInput()
                ->withErrors( $this->loginForm->errors() );
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$isEmfUser = Sentry::getUser();
		
		$this->session->destroy();
		Event::fire('user.logout');
		
		if( $isEmfUser && $isEmfUser->hasAnyAccess(['emf.login']))
			return Redirect::to( Config::get('kuu.emf_logout_redirect') );
		
		return Redirect::route('home', array('lang' =>App::getLocale()));
	}

}
