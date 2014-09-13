@extends('layouts.admin')

@section('title')
{{ trans('admin.create_user') }}
@stop

@section('content')
<script language="javascript">
	jQuery(document).ready(function() {
		$('[name = "password_change"]').click(function(){
			if($('[name = "password_change"]').prop('checked')){
				$('#password_group').css('display', 'block');
			}
			else {
				$('#password_group').css('display', 'none');
			}
		});
	});
</script>
<div class="span10">

	@if ($errors->has())
	@foreach ($errors->all() as $error)
	<div class='bg-danger alert'>{{ $error }}</div>
	@endforeach
	@endif

	<h1><i class='fa fa-user'></i> {{ trans('admin.edit_user') }}</h1>

	{{ Form::model($user, ['role' => 'form', 'url' => URL::route('admin.user',array('lang' =>App::getLocale())).'/'.$user->id, 'method' => 'PUT', 'class' => 'form-horizontal']) }}
		<div class="control-group">
			{{ Form::label('first_name', trans('admin.first_name'),['class' => 'control-label']) }}
			<div class='controls'>
				{{ Form::text('first_name', null, ['placeholder' => trans('admin.first_name')]) }}
			</div>
		</div>

		<div class='control-group'>
			{{ Form::label('last_name', trans('admin.last_name'),['class' => 'control-label']) }}
			<div class='controls'>
				{{ Form::text('last_name', null, ['placeholder' => trans('admin.last_name')]) }}
			</div>    
		</div>

		<div class='control-group'>
			{{ Form::label('email', trans('admin.email'),['class' => 'control-label']) }}
			<div class='controls'>
				{{ Form::email('email', null, ['placeholder' => trans('admin.email')]) }}
			</div>
		</div>

		<div class='control-group'>
			{{ Form::label('groups', trans('admin.groups'),['class' => 'control-label']) }}
			<div class='controls'>
				{{Form::select('groups[]', $groups_arr, $user_groups_arr, array('multiple' => true))}}
			</div>
		</div>

		<div class='control-group'>
			{{ Form::label('password_change', trans('admin.change_pass'),['class' => 'control-label']) }}
			<div class='controls'>
				{{ Form::checkbox('password_change', 'change') }}
			</div>
		</div>

		<div id="password_group" style="display:none">
			<div class='control-group'>
				{{ Form::label('password', trans('admin.password'),['class' => 'control-label']) }}
				<div class='controls'>
					{{ Form::password('password', ['placeholder' => trans('admin.password')]) }}
				</div>
			</div>

			<div class='control-group'>
				{{ Form::label('password_confirmation', trans('admin.confirm_pass'),['class' => 'control-label']) }}
				<div class='controls'>
					{{ Form::password('password_confirmation', ['placeholder' => trans('admin.confirm_pass')]) }}
				</div>
			</div>
		</div>

		<div class='control-group'>
			{{ Form::label('activated', trans('admin.activate'),['class' => 'control-label']) }}
			<div class='controls'>
				{{ Form::checkbox('activated', 'activated') }}
			</div>
		</div>

		<div class='control-group'>
			{{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) }}
			<a class = 'btn', href="{{URL::previous()}}">{{ trans('admin.cancel') }}</a>
		</div>
	{{ Form::close() }}

</div>

@stop