@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{ trans('users.home') }}
@stop

{{-- Content --}}
@section('content')
<h4>{{ trans('users.current_users') }}</h4>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>{{ trans('users.user') }}</th>
				<th>{{ trans('users.status') }}</th>
				<th>{{ trans('users.options') }}</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td><a href="{{ action('UserController@show', array($user->id)) }}">{{ $user->email }}</a></td>
						<td>{{ $user->status }} </td>
						<td>
							<button class="btn btn-default" type="button" onClick="location.href='{{ action('UserController@edit', array($user->id)) }}'">{{ trans('users.edit') }}</button> 
							@if ($user->status != 'Suspended')
								<button class="btn btn-default" type="button" onClick="location.href='{{ route('suspendUserForm', array($user->id)) }}'">{{ trans('users.suspend') }}</button> 
							@else
								<button class="btn btn-default" type="button" onClick="location.href='{{ action('UserController@unsuspend', array($user->id)) }}'">{{ trans('users.unsuspend') }}</button> 
							@endif
							@if ($user->status != 'Banned')
								<button class="btn btn-default" type="button" onClick="location.href='{{ action('UserController@ban', array($user->id)) }}'">{{ trans('users.ban') }}</button> 
							@else
								<button class="btn btn-default" type="button" onClick="location.href='{{ action('UserController@unban', array($user->id)) }}'">{{ trans('users.unban') }}</button> 
							@endif
							
							<button class="btn btn-default action_confirm" href="{{ action('UserController@destroy', array($user->id)) }}" data-token="{{ Session::getToken() }}" data-method="delete">{{ trans('users.delete') }}</button></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
  </div>
</div>
@stop
