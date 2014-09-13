@extends('layouts.admin')

@section('title')
{{ trans('admin.checks') }}
@stop

@section('content')
<script>
	$(function() {
		$('.delete_form').bind('click', function() {
			if(!confirm(" {{ trans('admin.confirmdeletecheck') }} ") )
				return false;
		});
	});
</script>
<div class="span10">
	<a href="{{ URL::route('logout',array('lang' =>App::getLocale())) }}" class="btn btn-default pull-right"><i class="icon-user"></i> {{ trans('admin.logout') }}</a>
	<a href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"class="btn btn-inverse pull-right"><i class="icon-file icon-white"></i> {{ trans('admin.dashboard') }}</a>
	<h1><i class="fa fa-check-square-o"></i> {{ trans('admin.users_checks') }}</h1>
	<h3>{{ Lang::choice('admin.of_user', ($user) ? $user->id : 0, array('email' => ($user) ? $user->email : '')) }}</h3>

	@if(Session::has('message'))
	<p class="alert alert-info">{{ Session::get('message') }}</p>
	@endif
	@if(Session::has('error_message'))
	<p class="alert alert-danger">{{ Session::get('error_message') }}</p>
	@endif

	<div class="table-responsive">
		<table class="table table-bordered table-striped">

			<thead>
			<tr>
				<th>{{ trans('admin.check_num') }}</th>
				<th>{{ trans('admin.type') }}</th>
				<th>{{ trans('admin.domain') }}</th>
				<th>{{ trans('admin.url') }}</th>
				<th>{{ trans('admin.host') }}</th>
				<th>{{ trans('admin.options') }}</th>
				<th>{{ trans('admin.alert_email') }}</th>
				<th style="width:250px">{{ trans('admin.actions') }}</th>
			</tr>
			</thead>

			<tbody>
			@foreach ($checks as $check)

			<tr>
				<td>{{ $check->check_id }}</td>
				<td>{{ $check->type }}</td>
				<td>{{ $check->domain }}</td>
				<td>{{ $check->url }}</td>
				<td>{{ $check->host }}</td>
				<?php $options = ($check->options) ? json_decode($check->options) : array() ?>
				<td>
					@foreach($options as $key => $option)
						<span class="btn btn-mini disabled"><b>{{$key}} :</b> {{$option }}</span>
					@endforeach
				</td>
				<td>
					<a href="{{URL::route('admin',array('lang' =>App::getLocale()))}}/alert/{{$check->check_id}}" class="btn btn-mini btn-info pull-left"><i class="icon-envelope"></i> {{ trans('admin.edit_emails') }}</a>
					@foreach($check->checkalertemail as $alert)
					<span class="btn btn-mini disabled">{{$alert->alert_email }}</span>
					@endforeach
				</td>
				<td>
					<a href="{{ URL::route('admin.check',array('lang' =>App::getLocale())) }}/{{ $check->user_id }}/{{ $check->check_id }}/edit" class="btn btn-small btn-info pull-left" style="margin-right: 3px;"><i class="icon-edit"></i> {{ trans('admin.edit') }}</a>
					{{ Form::open(['url' => URL::route('admin.check',array('lang' =>App::getLocale())).'/'. $check->user_id .'/'. $check->check_id . '/suspend' , 'method' => 'PUT', 'class' => 'nomrg']) }}
					{{ Form::hidden('page', $checks->getCurrentPage()) }}
					{{ HTML::decode(Form::button('<i class="icon-time"></i> '.(($check->paused) ? trans('admin.resume') : trans('admin.suspend') ), array('type' => 'submit','class' => 'btn btn-small pull-left'))) }}
					{{ Form::close() }}

					{{ Form::open(['url' => URL::route('admin.check',array('lang' =>App::getLocale())).'/'. $check->user_id .'/'. $check->check_id , 'method' => 'DELETE', 'class' => 'nomrg']) }}
					{{ Form::hidden('page', $checks->getCurrentPage()) }}
					{{ HTML::decode(Form::button('<i class="icon-trash"></i> '.trans('admin.delete'), array('type' => 'submit','class' => 'btn btn-small btn-danger pull-left delete_form'))) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
			</tbody>

		</table>
		@if($user)
			<a href="{{URL::route('admin.check',array('lang' =>App::getLocale()))}}/{{$user->id}}/create" class="btn btn-success pull-right">{{ trans('admin.add_check') }}</a>
		@endif
	</div>

	<?php echo $checks->links(); ?>

	<a href="{{URL::route('admin.user',array('lang' =>App::getLocale()))}}" class="btn pull-left">{{ trans('admin.return') }}</a>
</div>

@stop