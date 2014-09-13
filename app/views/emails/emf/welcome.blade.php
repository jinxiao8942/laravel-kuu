@extends('layouts.email')

@section('title_short')
{{ trans('emails.welcometokuu') }} 
@stop

@section('title_long')
{{ trans('emails.welcometomonserv') }} 
@stop

@section('body')
<br />
<br />
{{ trans('emails.thanksforactivating') }} 
<br />
<br />
{{ trans('emails.gettingstarted') }} 
<br />
<br />
{{ trans('emails.donothesitate') }} 
<br />
<br />
{{ trans('emails.regards') }} 
<br />
<br />
@stop
