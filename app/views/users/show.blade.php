@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{ trans('users.home') }}
@stop

{{-- Content --}}
@section('content')
	<h4>{{ trans('users.account_profile') }}</h4>
	
  	<div class="well clearfix">
	    <div class="col-md-8">
		    @if ($user->first_name)
		    	<p><strong>{{ trans('users.first_name') }}:</strong> {{ $user->first_name }} </p>
			@endif
			@if ($user->last_name)
		    	<p><strong>{{ trans('users.last_name') }}:</strong> {{ $user->last_name }} </p>
			@endif
		    <p><strong>{{ trans('users.email') }}:</strong> {{ $user->email }}</p>
		    
		</div>
		<div class="col-md-4">
			<p><em>{{ trans('users.account_created') }}: {{ $user->created_at }}</em></p>
			<p><em>{{ trans('users.last_updated') }}: {{ $user->updated_at }}</em></p>
			<button class="btn btn-primary" onClick="location.href='{{ action('UserController@edit', array($user->id)) }}'">{{ trans('users.edit_profile') }}</button>
		</div>
	</div>

	<h4>{{ trans('users.group_memberships') }}:</h4>
	<?php $userGroups = $user->getGroups(); ?>
	<div class="well">
	    <ul>
	    	@if (count($userGroups) >= 1)
		    	@foreach ($userGroups as $group)
					<li>{{ $group['name'] }}</li>
				@endforeach
			@else 
				<li>{{ trans('users.nogroupmembs') }}.</li>
			@endif
	    </ul>
	</div>
	
	<hr />

<!-- 	<h4>User Object</h4>
	<div>
		<p>{{ var_dump($user) }}</p>
	</div> -->

@stop
