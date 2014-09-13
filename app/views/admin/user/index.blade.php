@extends('layouts.admin')

@section('title')
{{ trans('admin.user') }}
@stop



@section('content')

<div class="span10">

    <a href="{{ URL::route('logout',array('lang' =>App::getLocale())) }}" class="btn btn-default pull-right"><i class="icon-user"></i> {{ trans('admin.logout') }}</a>
    <a href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"class="btn btn-inverse pull-right"><i class="icon-file icon-white"></i> {{ trans('admin.dashboard') }}</a>
    <h1><i class="fa fa-users"></i> {{ trans('admin.user_admin') }}</h1>
    <span><strong>{{ trans('admin.totalusers', array('users' => $users_count)) }}</strong></span>
    {{ Form::open(['url' => URL::route('admin.user',array('lang' =>App::getLocale())), 'method' => 'GET', 'class' => 'form-search pull-right']) }}
        <div class="input-append">
            <input type="search" name = "search_string" class="span2 search-query" style="width: 150px" value="{{$search_string}}">
            <button type="submit" class="btn"><i class="icon-search"></i></button>
        </div>
    {{ Form::close() }}
    @if(Session::has('message'))
    <p><br><br></p>
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    @if(Session::has('error_message'))
    <p><br><br></p>
    <p class="alert alert-danger">{{ Session::get('error_message') }}</p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th style="padding: 0px 0px 0px;">
                    @include('admin.user.sorting', array('field_name' => 'first_name', 'column_name' => trans('admin.name') ))
                    <!-- <a href="{{ URL::route('admin.user') }}?{{($page > 1) ? 'page='.$page.'&' : ''}}sort=first_name&order={{(isset($sort) && $sort == 'first_name' && $order == 'asc') ? 'desc' : 'asc'}}">Name</a> {{(isset($sort) && $sort == 'first_name') ? (($order == 'asc') ? '↓' : '↑') : '' }}-->
                </th>
                <th style="padding: 0px 0px 0px;">
                    @include('admin.user.sorting', array('field_name' => 'Email', 'column_name' => trans('admin.email')))
                </th>
                <th style="padding: 0px 0px 0px;">
                    @include('admin.user.sorting', array('field_name' => 'created_at', 'column_name' => trans('admin.dt_add')))
                </th>
                <th>{{ trans('admin.activated') }}</th>
                <th>{{ trans('admin.groups') }}</th>
                <th>{{ trans('admin.actions') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
            <?php
                $throttle = Sentry::findThrottlerByUserId($user->id);
                $banned = $throttle->isBanned();
            ?>
            <tr>
                <td>{{ $user->getFullName() }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                <td>{{ ($user->activated) ? '<i class="icon-ok icon-black"></i>' : '<i class="icon-remove icon-black"></i>' }}</td>
                <td>
                    @foreach ($user->groups()->get() as $group)
                    <a href="#" class="btn btn-small disabled">{{$group->name}}</a>
                    @endforeach
                </td>
                <td style="width:250px">
                    <a href="{{ URL::route('admin.check',array('lang' =>App::getLocale())) }}/{{ $user->id }}" class="btn pull-left" style="margin-right: 3px;"><i class="icon-check"></i>{{ trans('admin.checks') }}</a>
                    <a href="{{ URL::route('admin.user',array('lang' =>App::getLocale())) }}/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">{{ trans('admin.edit') }}</a>
                    {{ Form::open(['url' => URL::route('admin.user',array('lang' =>App::getLocale())).'/'.$user->id  , 'method' => 'DELETE']) }}
                    {{ Form::hidden('page', $users->getCurrentPage()) }}
                    {{ Form::hidden('search_string', $search_string) }}
                    {{ ($banned) ? Form::submit(trans('admin.unban'), ['class' => 'btn btn-info']) : Form::submit(trans('admin.ban'), ['class' => 'btn btn-danger pull-left'])}}
                    {{ Form::close() }}

                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{URL::route('admin.user',array('lang' =>App::getLocale()))}}/create" class="btn btn-success pull-right">{{ trans('admin.add_user') }}</a>
    <?php  echo $users->appends($parameters)->links();    ?>
</div>

@stop