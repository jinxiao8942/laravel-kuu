@extends('layouts.email')

@section('title_short')
{{ $title }}
@stop

@section('title_long')
{{ $title }}
@stop

@section('body')
<p>{{ trans('emails.your') }} 

@if ( $protocol === "dns" )
{{ trans('emails.domain_name') }} 
@elseif ( $protocol === "http" )
{{ trans('emails.website') }} 
@elseif ( $protocol === "https" )
{{ trans('emails.secure_website') }} 
@else
@endif

{{ trans('emails.monitor') }}</p>
<p>{{ $alert_email->url }}</p>

@if ( $type === "down" )
<p>{{ trans('emails.hasbeendown') }} 
@else
<p>{{ trans('emails.itwasdown') }} 
@endif


@if ( $downtime/60 < 60 )
	{{ round($downtime/60) }} {{ trans('emails.minutes') }}
@elseif ( $downtime/60 < 60*24 )
	{{ intval($downtime/3600) }} {{ trans('emails.hours') }} {{ ($downtime/60) % 60 }} {{ trans('emails.minutes') }}
@else
	{{ intval($downtime/(3600*24)) }} {{ trans('emails.days') }} {{ ($downtime/3600) % 24 }} {{ trans('emails.hours') }} {{ ($downtime/60) % 60 }} {{ trans('emails.minutes') }}
@endif

</p>
<p>{{ trans('emails.since') }} {{ $time_formatted }}.</p>                                                    

@if ( $type === "down" )
<p>{{ trans('emails.errormessage') }}</p>
<p>{{ $last_checked_status }} - {{ $http_error_descriptions[$last_checked_status] ? $http_error_descriptions[$last_checked_status] : $http_error_descriptions["default"] }}</p>
@endif

@stop
