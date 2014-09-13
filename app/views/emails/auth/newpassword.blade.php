@extends('layouts.email')

@section('title_short')
{{ trans('emails.kuunewpass') }}
@stop

@section('title_long')
{{ trans('emails.kuunewpass') }}
@stop

@section('body')
{{ trans('emails.kuupassreset') }}
<br />
<br />
{{ trans('emails.yournewpass') }} <span style="outline: none; color: #00aeef; font-weight: bold; text-decoration: none;">{{{ $newPassword }}}</span>
<br />
<br />
{{ trans('emails.usepass') }}
<br />
<br />
@stop
