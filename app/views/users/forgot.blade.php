@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{ trans('users.forgot_password') }}
@stop

{{-- Body Class --}}
@section('body_class')
@parent
login
@stop

{{-- Content --}}
@section('content')

<div class="content">

        {{ Form::open(array('action' => 'UserController@forgot', 'method' => 'post', 'class' => 'form-vertical')) }}
            
			<h3 class="">{{ trans('users.forget_password') }}</h3>
            
			<p>{{ trans('users.enteremail') }}</p>
			
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope-alt"></i>
						{{ Form::text('email', null, array('class' => 'm-wrap', 'placeholder' => trans('users.email'), 'autofocus')) }}
					</div>
				</div>
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
			</div>

			<div class="form-actions">
				<a href="{{ URL::route('home',array('lang' =>App::getLocale())) }}" id="back-btn" class="btn">
					<i class="m-icon-swapleft"></i> {{ trans('users.back') }}
				</a>
				<button type="submit" id="login-btn" class="btn green pull-right">
					{{ trans('users.send_instructions') }} <i class="m-icon-swapright m-icon-white"></i>
				</button>				
			</div>
  		{{ Form::close() }}

</div>

@stop