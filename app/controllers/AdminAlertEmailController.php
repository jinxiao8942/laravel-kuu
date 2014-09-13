<?php

class AdminAlertEmailController extends \BaseController {

    protected $layout = 'layouts.admin';

    public function __construct() {

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($lang, $check_id = '')
    {
        if(intval($check_id)) {
            if($check = Check::find($check_id)) {
                return View::make('admin.alertmail.edit', ['check' => $check]);
            }
        }
        Session::flash('error_message', trans('kuu-validation.check_not_found'));
        return Redirect::route('admin.user', array('lang' =>App::getLocale()));
    }

    public function store($lang, $check_id = '')
    {
        if(intval($check_id)) {
            if($check = Check::find($check_id)) {
               // Log::info($check->check_id);
                $check_alert_email = new CheckAlertEmail;
                    if($check_alert_email->store_alert_email(Input::all())) {
                        Session::flash('message', trans('kuu-validation.email_was_added'));
                        return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
                        //to('/admin/alert/'.$check_id);
                    }
                    else {
                        Session::flash('error_message', $check_alert_email->get_error_message());
                        return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
                        //to('/admin/alert/'.$check_id);
                    }
            }
        }

        Session::flash('error_message', trans('kuu-validation.check_not_found'));
        return Redirect::route('admin.user', array('lang' =>App::getLocale()));
    }


    public function destroy($lang, $check_id)
    {
        $alert_id = intval(Input::get('alert_id'));
        if((CheckAlertEmail :: where('alert_id','=',$alert_id)->count() == 1)){
            $check_alert_email = CheckAlertEmail :: where('alert_id','=',$alert_id)->first();
            if($check_alert_email->delete()) {
                Session::flash('message', trans('kuu-validation.alert_email_was_deleted'));
                return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
                //return Redirect::to('/admin/alert/'.$check_id);
            }
            else {
                Session::flash('error_message', trans('kuu-validation.alert_email_was_not_deleted'));
                return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
                //return Redirect::to('/admin/alert/'.$check_id);
            }
        }
        else {
            Session::flash('error_message', trans('kuu-validation.alert_email_was_not_found'));
            //return Redirect::to('/admin/alert/'.$check_id);
            return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
        }
    }

    public function update($lang, $check_id, $alert_id)
    {
        if($alert_id != intval(Input::get('alert_id'))){
            Session::flash('error_message', trans('kuu-validation.alert_email_was_not_found'));
            //return Redirect::to('/admin/alert/'.$check_id);
            return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
        }
        if((CheckAlertEmail :: where('alert_id','=',$alert_id)->count() == 1)){
            $check_alert_email = CheckAlertEmail :: where('alert_id','=',$alert_id)->first();
            if($check_alert_email->update_alert_email(Input::all())) {
            Session::flash('message', trans('kuu-validation.alert_email_was_updated'));
            //return Redirect::to('/admin/alert/'.$check_id);
                return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
            }
            else {
                Session::flash('error_message', $check_alert_email->get_error_message());
                //return Redirect::to('/admin/alert/'.$check_id);
                return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
            }
        }
        else {
            Session::flash('error_message', trans('kuu-validation.alert_email_was_not_found'));
            //return Redirect::to('/admin/alert/'.$check_id);
            return Redirect::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check_id));
        }
    }
}