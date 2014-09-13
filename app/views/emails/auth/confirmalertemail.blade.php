@extends('layouts.email')

@section('title_short')
{{ trans('emails.verifyemail') }}
@stop

@section('title_long')
{{ trans('emails.verifynewemail') }}
@stop

@section('body')
{{ trans('emails.to_verify1') }} <a href="mailto:{{{ $email }}}" style="color: #555555; font-weight: bold; text-decoration: none;"><span>{{{ $email }}}</span></a> {{ trans('emails.to_verify2') }}
<br />
<br />
<a href="{{ URL::to('alerts') }}/{{ $alertEmailId }}/activate/{{ urlencode($activationCode) }}" style="outline: none; color: #00aeef; font-weight: bold; text-decoration: none;">{{ URL::to('alerts') }}/{{ $alertEmailId }}/activate/{{ urlencode($activationCode) }}</a>
<br />
<br />
@stop
