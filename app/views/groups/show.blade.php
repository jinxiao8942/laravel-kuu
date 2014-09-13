@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{ trans('groups.view_group') }}
@stop

{{-- Content --}}
@section('content')
<h4>{{ $group['name'] }} {{ trans('groups.group') }}</h4>
<div class="well clearfix">
	<div class="col-md-10">
		<strong>{{ trans('groups.permissions') }}:</strong>
		<ul>
			@foreach ($group->getPermissions() as $key => $value)
				<li>{{ ucfirst($key) }}</li>
			@endforeach
		</ul>
	</div>
	<div class="col-md-2">
		<button class="btn btn-primary" onClick="location.href='{{ action('GroupController@edit', array($group->id)) }}'">{{ trans('groups.edit_group') }}</button>
	</div> 
</div>
<hr />
<h4>{{ trans('groups.group_object') }}</h4>
<div>
	<!-- {{ var_dump($group) }} -->
</div>

@stop
