@extends('layouts.email')

@section('title_short')
{{ trans('emails.password_reset') }}
@stop

@section('title_long')
{{ trans('emails.verifytorespass') }}
@stop

@section('body')
{{ trans('emails.torespass') }} <a href="{{ URL::to('users') }}/{{ $userId }}/reset/{{ urlencode($resetCode) }}" style="outline: none; color: #00aeef; font-weight: bold; text-decoration: none;"><span>{{ trans('emails.click_here') }}</span></a>.
{{ trans('emails.ifnotrequest') }}
<br />
<br />
{{ trans('emails.orpoint') }}
<br />
<br /> <a href="{{ URL::to('users') }}/{{ $userId }}/reset/{{ urlencode($resetCode) }}" style="outline: none; color: #00aeef; font-weight: bold; text-decoration: none;">{{ URL::to('users') }}/{{ $userId }}/reset/{{ urlencode($resetCode) }}</a>
<br />
<br />
@stop

