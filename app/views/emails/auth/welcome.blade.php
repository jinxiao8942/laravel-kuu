@extends('layouts.email')

@section('title_short')
{{ trans('emails.verifyyourkuu') }}
@stop

@section('title_long')
{{ trans('emails.verifyandsetid') }}
@stop

@section('body')
{{ trans('emails.to_verify') }} <a href="mailto:{{{ $email }}}" style="color: #555555; font-weight: bold; text-decoration: none;"><span>{{{ $email }}}</span></a> {{ trans('emails.clicklink') }}
<br />
<br />
<a href="{{ URL::to('users') }}/{{ $userId }}/activate/{{ urlencode($activationCode) }}" style="outline: none; color: #00aeef; font-weight: bold; text-decoration: none;">{{ URL::to('users') }}/{{ $userId }}/activate/{{ urlencode($activationCode) }}</a>
<br />
<br />
{{ trans('emails.accesstokuusupport') }}
<br />
<br />
@stop
