@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{ trans('groups.groups') }}
@stop

{{-- Content --}}
@section('content')
<h4>{{ trans('groups.available_groups') }}</h4>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>{{ trans('groups.name') }}</th>
				<th>{{ trans('groups.permissions') }}</th>
				<th>{{ trans('groups.options') }}</th>
			</thead>
			<tbody>
			@foreach ($groups as $group)
				<tr>
					<td><a href="groups/{{ $group->id }}">{{ $group->name }}</a></td>
					<td>{{ (isset($group['permissions']['admin'])) ? '<i class="icon-ok"></i>' {{ trans('groups.admin') }} : ''}} {{ (isset($group['permissions']['users'])) ? '<i class="icon-ok"></i>' {{ trans('groups.users') }} : ''}}</td>
					<td>
						<button class="btn btn-default" onClick="location.href='{{ action('GroupController@edit', array($group->id)) }}'">{{ trans('groups.edit') }}</button>
					 	<button class="btn btn-default action_confirm {{ ($group->id == 2) ? 'disabled' : '' }}" type="button" data-method="delete" href="{{ URL::to('groups') }}/{{ $group->id }}">{{ trans('groups.delete') }}</button>
					 </td>
				</tr>	
			@endforeach
			</tbody>
		</table> 
	</div>
	 <button class="btn btn-primary" onClick="location.href='{{ URL::to('groups/create') }}'">{{ trans('groups.new_group') }}</button>
   </div>
</div>
<!--  
	The delete button uses Resftulizer.js to restfully submit with "Delete".  The "action_confirm" class triggers an optional confirm dialog.
	Also, I have hardcoded adding the "disabled" class to the Admin group - deleting your own admin access causes problems.
-->
@stop

