@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{ trans('users.suspend_user') }}
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {{ Form::open(array('action' => array('UserController@suspend', $id), 'method' => 'post')) }}
 
            <h2>{{ trans('users.suspend_user') }}</h2>

            <div class="form-group {{ ($errors->has('minutes')) ? 'has-error' : '' }}">
                {{ Form::text('minutes', null, array('class' => 'form-control', 'placeholder' => trans('users.minutes'), 'autofocus')) }}
                {{ ($errors->has('minutes') ? $errors->first('minutes') : '') }}
            </div>    	   

            {{ Form::hidden('id', $id) }}

            {{ Form::submit(trans('users.suspend_user'), array('class' => 'btn btn-primary')) }}
            
        {{ Form::close() }}
    </div>
</div>

@stop