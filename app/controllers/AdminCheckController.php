<?php

class AdminCheckController extends \BaseController {

    protected $layout = 'layouts.admin';

    public function __construct() {

    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($lang,$user_id = '')
	{
        $user = false;
        if(intval($user_id)) {
            $user = User::find($user_id);
            $checks = Check::where('user_id', '=', $user_id)->paginate(Config::get('kuu.checks_per_page'));
        }
        else {
            $checks = Check::paginate(Config::get('kuu.checks_per_page'));
        }

        return View::make('admin.check.index', ['checks' => $checks, 'user' => $user]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($lang,$user_id = '')
	{
        $user = User::find($user_id);
        if($user) {
            $check = new stdClass();
            return View::make('admin.check.create', ['check' => $check, 'user_id' => $user_id ]);
        }
        else {
            Session::flash('error_message', trans('kuu-validation.user_not_found'));
            return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
        }
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($lang,$user_id = '')
	{
        $user = User::find(intval(Input::get('user_id')));
        if($user) {
            $check = new Check;
            if($check->store_check(Input::all())) {
                Session::flash('message', trans('kuu-validation.check_information_was_updated'));
                //return Redirect::to('/admin/check/'.$user_id);
                return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
            }
            else {
                Session::flash('error_messages', $check->validate_errors);
            }
        }
        else {
            Session::flash('error_message', trans('kuu-validation.user_not_found').intval(Input::get('user_id')));
            //return Redirect::to('/admin/check/'.$user_id);
            return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
        }
        $check = (object)Input::all();
        return View::make('admin.check.create', [ 'check' => $check,  'user_id' => $user_id  ]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($lang,$user_id =0,$check_id = 0)
	{
		$check = Check::where('user_id', '=', intval($user_id))->where('check_id','=',intval($check_id))->get();
        if($check->count() == 1) {
            $check = $check->first();
            $options = json_decode($check->options);
            $check->phrases = isset($options->phrases_to_match) ? $options->phrases_to_match : '';
            $check->post_body = isset($options->post_body) ? $options->post_body : '';
            $check->edit_options = false;
            return View::make('admin.check.edit', [ 'check' => $check , 'user_id' => $user_id]);
        }
        else {
            Session::flash('error_message', trans('kuu-validation.check_was_not_found').' '.$user_id.' '.$check_id.' '.$check->count());
            //return Redirect::to('/admin/check/'.$user_id);
            return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
        }
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($lang,$user_id,$check_id)
	{
        if((Check :: where('check_id','=',$check_id)->count() == 1)){
            $check = Check :: where('check_id','=',$check_id)->first();
            if($check->update_check(Input::all())) {
                Session::flash('message', trans('kuu-validation.check_information_was_updated'));
                //return Redirect::to('/admin/check/'.$user_id);
                return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
            }
            else {
                Session::flash('error_messages', $check->validate_errors);
            }
        }
        else {
            Session::flash('error_message', trans('kuu-validation.check_was_not_found'));
            //return Redirect::to('/admin/check/'.$user_id);
            return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
        }

        $check = (object)Input::all();
        return View::make('admin.check.edit', [ 'check' => $check , 'user_ud' => $user_id]);
	}

    public function suspend($lang,$user_id,$check_id)
    {
        if((Check :: where('check_id','=',$check_id)->count() == 1)){
            $check = Check :: where('check_id','=',$check_id)->first();
            if($check->suspend_check()) {
                if($check->paused)
                    Session::flash('message', trans('kuu-validation.check_was_suspended'));
                else
                    Session::flash('message', trans('kuu-validation.check_was_resumed'));
                //$path = (Input::get('page', 1) > 1) ? '?page='.Input::get('page') : '';
                //return Redirect::to('/admin/check/'.$user_id.$path);
                return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id, 'page' => Input::get('page')));
            }
            else
                Session::flash('error_messages', trans('kuu-validation.check_was_not_saved'));
        }
        else {
            Session::flash('error_message', trans('kuu-validation.check_was_deleted'));
            return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
        }

    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($lang,$user_id,$check_id)
	{
        if((Check :: where('check_id','=',$check_id)->count() == 1)){
            $check = Check :: where('check_id','=',$check_id)->first();
            if($check->delete_check()) {
                Session::flash('message', trans('kuu-validation.check_was_deleted'));
                //$path = (Input::get('page', 1) > 1) ? '?page='.Input::get('page') : '';
                //return Redirect::to('/admin/check/'.$user_id.$path);
                return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id, 'page' => Input::get('page')));
            }
            else
                Session::flash('error_messages', trans('kuu-validation.check_was_not_deleted'));
        }
        else {
            Session::flash('error_message', trans('kuu-validation.check_was_not_found'));
            return Redirect::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' =>$user_id));
        }
	}
}
