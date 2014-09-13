<?php

class AdminUserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = new User();
        $sort=Input::get('sort','');
        $order=Input::get('order','');
        if(($s=Input::get('search_string')) != ''){
            $users = $users->where('email', 'like', '%'.$s.'%')->orWhere('first_name', 'like', '%'.$s.'%')->orWhere('last_name', 'like', '%'.$s.'%');
        }
        if(($sort != '') && ($order != '')){
            $users = $users->orderBy($sort, $order);
        }
        //set parameters
        $p = array('search_string' => $s);
        if($sort != ''){
            $p['sort'] = $sort;
            if($order != '')
                $p['order'] = $order;
        }
        $users = $users->paginate( Config::get('kuu.users_per_page'));
        return View::make('admin.user.index', ['users' => $users, 'search_string' => $s, 'users_count' => User::count(), 'page'=> Input::get('page', 1), 'sort' => $sort, 'order' => $order, 'parameters' => $p ]);
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $groups = Sentry::findAllGroups();
        $groups_arr = array();
        $user_groups_arr = array();
        foreach($groups as $group){
            $groups_arr[$group->id] = $group->name;
        }
        return View::make('admin.user.create', ['groups_arr' => $groups_arr, 'user_groups_arr' => $user_groups_arr ]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        try
        {
            $user = Sentry::createUser(array(
                'email'     => Input::get('email'),
                'password'  => (string)(Input::get('password')),
                'activated' => (Input::get('activated') == 'activated') ? 1 : 0,
                'first_name' => Input::get('first_name'),
                'last_name'  => Input::get('last_name')
            ));
            if($user->id) {
                Session::flash('message', trans('kuu-validation.user_create_successfully'));
                $groups_arr = Input::get('groups');
                foreach($groups_arr as $group_id){
                    $group = Sentry::findGroupById($group_id);
                    $user->addGroup($group);
                }
            }
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            Session::flash('error_message', trans('kuu-validation.login_field_is_required'));
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            Session::flash('error_message', trans('kuu-validation.password_field_is_required'));
}
        catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            Session::flash('error_message', trans('kuu-validation.user_with_this_login_already_exists'));
        }


        //return Redirect::to('/admin/user');
        return Redirect::route('admin.user',array('lang' =>App::getLocale()));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($lang, $id)
	{
        try {
            $user = Sentry::findUserById($id);
            $groups = Sentry::findAllGroups();
            $groups_arr = array();
            $user_groups_arr = array();
            foreach($groups as $group){
                $groups_arr[$group->id] = $group->name;
                if($user->inGroup($group)) {
                    array_push($user_groups_arr, $group->id);
                }
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            Session::flash('error_message', trans('kuu-validation.user_was_not_found'));
            //return Redirect::to('/admin/user');
            return Redirect::route('admin.user',array('lang' =>App::getLocale()));
        }

        return View::make('admin.user.edit', [ 'user' => $user, 'groups_arr' => $groups_arr, 'user_groups_arr' => $user_groups_arr ]);
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($lang,$id)
	{
        try
        {
            $user = Sentry::findUserById($id);
            $user->first_name = Input::get('first_name', '');
            $user->last_name  = Input::get('last_name', '');
            $user->email      = Input::get('email');
            $groups = Sentry::findAllGroups();
            $groups_arr = Input::get('groups', array());
            foreach($groups as $group){
                if(in_array($group->id, $groups_arr))
                    $user->addGroup($group);
                else {
                    if($user->inGroup($group)) {
                        $user->removeGroup($group);
                    }
                }
            }

            if(Input::get('password_change') == 'change')
                $user->password   = (string)Input::get('password');

            $user->activated = (Input::get('activated') == 'activated') ? 1 : 0;
            $user->updated_at = time();

            if($user->save()) {
                Session::flash('message', trans('kuu-validation.user_information_was_updated'));
            }
            else {
                Session::flash('error_message', trans('kuu-validation.user_information_was_not_updated'));
            }
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            Session::flash('error_message', trans('kuu-validation.user_with_this_login_already_exists'));
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            Session::flash('error_message', trans('kuu-validation.user_was_not_found').' '.$id);
        }
        //return Redirect::to('/admin/user');
        return Redirect::route('admin.user',array('lang' =>App::getLocale()));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($lang, $id)
	{
        /*
        $user = Sentry::findUserById($id);
        $user->delete();
        */
        try {
            $throttle = Sentry::findThrottlerByUserId($id);

            if($banned = $throttle->isBanned()){
                $throttle->unBan();
                Session::flash('message', trans('kuu-validation.user_was_unbanned_successfully'));
            }
            else {
                $throttle->ban();
                Session::flash('message', trans('kuu-validation.user_was_banned_successfully'));
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Session::flash('error_message', trans('kuu-validation.user_was_not_found').' '.$id);

        }
        //return Redirect::to('/admin/user?search_string='.Input::get('search_string').'&page='.Input::get('page'));
        return Redirect::route('admin.user',array('lang' =>App::getLocale(), 'search_string' => Input::get('search_string'), 'page' => Input::get('page')));
	}
}
