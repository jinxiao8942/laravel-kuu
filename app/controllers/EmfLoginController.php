<?php

class EmfLoginController extends \BaseController {

    public function generateToken() {
        $salt =  Config::get('kuu.emf_salt');
        $email = Input::get('email', null);
        $first_name = Input::get('first_name', '');
        $last_name = Input::get('last_name', '');
        $emf_user_id = Input::get('emf_user_id', null);
        $signature = Input::get('signature', null);
        if($email && $emf_user_id && $signature) {
            Log::info('generateToken() '.$email.' '.$emf_user_id.' '.$signature);
            if(sha1($salt.$emf_user_id.$email) == $signature) {
                Log::info('generateToken() valid signature');
                do {
                    $token = md5(uniqid(mt_rand(), true));
                } while(User::where('emf_token','=',$token)->count());
                if(User::where('emf_user_id','=',$emf_user_id)->count()){
                    $user = User::where('emf_user_id','=',$emf_user_id)->first();
                    $check_email = User::where('email','=',$email)->first();
                    if(User::where('email','=',$email)->count() && ($check_email->id != $user->id)){
                        Log::info('generateToken() User with this login already exists.');
                        return json_encode(array('error' => trans('kuu-validation.user_with_this_login_already_exists')));
                    }
                    else {
                        $sentry_user = Sentry::findUserById($user->id);
                        $sentry_user->password = $token;
                        $sentry_user->emf_token  = $token;
                        $sentry_user->email      = $email;
                        $sentry_user->first_name = $first_name;
                        $sentry_user->last_name = $last_name;
                        $sentry_user->updated_at = time();
                        if($sentry_user->save()) {
                            Log::info('generateToken() User information was updated.');
                            return json_encode(array('token' => $token));
                        }
                        else {
                            Log::info('generateToken() User information was not updated!');
                            return json_encode(array('error' => trans('kuu-validation.user_information_was_not_updated')));
                        }
                    }
                }
                else {
                    try {
                        $sentry_user = Sentry::createUser(array(
                            'email'     => $email,
                            'password'  => $token,
                            'activated' => 1,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'emf_token' => $token,
                            'emf_user_id' => $emf_user_id,
                        ));
                        if($sentry_user->id) {
                            Session::flash('message', trans('kuu-validation.user_create_successfully'));
                            $group = Sentry::findGroupByName('EmfUsers');
                            $sentry_user->addGroup($group);
                            Log::info('generateToken() User '.$email.' was created.');
                            return json_encode(array('token' => $token));
                        }
                    }
                    catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                        Log::info('generateToken() User with this login already exists.');
                        return json_encode(array('error' => trans('kuu-validation.user_with_this_login_already_exists')));
                    }
                }
            }
            else {
                Log::info('generateToken() invalid signature!');
                return json_encode(array('error' => trans('kuu-validation.invalid_signature')));
            }
        }
        else {
            Log::info('generateToken() parameters not present');
            return json_encode(array('error' => trans('kuu-validation.invalid_request')));
        }
    }

    public function loginByToken($token = '') {
        if($token){
            $token = base64_decode($token);
            if(User::where('emf_token','=',$token)->count()){
                $user = User::where('emf_token','=',$token)->first();
                if(is_null($user->last_login)) {
                    $start_page = 'walkthrough';
                    $maildata = new stdClass();
                    $maildata->user = $user->toArray();
                    Mail::later(8, 'emails.emf.welcome', (array)$maildata, function($message) use ($user)
                    {
                        $message->to($user->email, ($user->first_name && $user->last_name) ? $user->first_name.' '.$user->last_name : null)->subject('Welcome!');
                    });
                }
                else
                    $start_page = 'dashboard';
                $sentry_user = Sentry::findUserById($user->id);
                Sentry::login($sentry_user, false);
                $user->password = md5(uniqid(mt_rand(), true));
                $user->emf_token  = null;
                $user->updated_at = time();
                if($user->save()) {
                    Log::info('loginByToken() User information was updated.');
                }
                else {
                    Log::info('loginByToken() User information was not updated!');
                }
                return Redirect::route($start_page, array('lang' =>App::getLocale()));
            }
            else
                return Redirect::route('login', array('lang' =>App::getLocale()));
        }
        else
            return Redirect::route('login', array('lang' =>App::getLocale()));
    }
}
