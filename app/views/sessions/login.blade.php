@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
{{ trans('sessions.log_in') }}
@stop

{{-- Body Class --}}
@section('body_class')
@parent
login
@stop

{{-- Content --}}
@section('content')

<!-- BEGIN LOGIN -->
<div class="content">
{{ Form::open(array('id' => 'login_form', 'action' => 'SessionController@store', 'class' => 'form-vertical login-form')) }}
	<h3 class="form-title">{{ trans('sessions.logtoacc') }}</h3>
	
	<div class="control-group">
		<div class="controls">
			<div class="input-icon left">
				<i class="icon-envelope-alt"></i>
				{{ Form::text('email', null, array('class' => 'm-wrap', 'placeholder' => trans('sessions.email'), 'autofocus')) }}
			</div>
			{{ ($errors->has('email') ? $errors->first('email') : '') }}
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<div class="input-icon left">
				<i class="icon-lock"></i>
				{{ Form::password('password', array('class' => 'm-wrap', 'placeholder' => trans('sessions.password')))}}
			</div>
			{{ ($errors->has('password') ?  $errors->first('password') : '') }}
		</div>
	</div>
	<div class="form-actions">
		<label class="checkbox">
			{{ Form::checkbox('rememberMe', 'rememberMe') }} {{ trans('sessions.keepin') }}
		</label>
		<div class="clearfix"></div>
		<p></p>
		<a href="{{ URL::route('home') }}" id="back-btn" class="btn pull-left">
			<i class="m-icon-swapleft m-icon-black"></i> {{ trans('sessions.back') }}
		</a>
		<button type="submit" id="login-btn" class="btn green pull-right">
			{{ trans('sessions.log_in') }} <i class="m-icon-swapright m-icon-white"></i>
		</button>
	</div>
	<div class="forget-password">
		<h5>{{ trans('sessions.noaccount') }} <a href="{{ URL::route('register',array('lang' =>App::getLocale())) }}">{{ trans('sessions.sign_up_now') }}</a></h5>
		<h5><a href="{{ route('forgotPasswordForm') }}" class="" id="forget-password">{{ trans('sessions.forgotpass') }}</a></h5>
	</div>
	<!--a class="btn btn-link" href="{{ route('forgotPasswordForm') }}">Forgot Password</a//-->
{{ Form::close() }}

</div>
<!-- END LOGIN -->

@stop
