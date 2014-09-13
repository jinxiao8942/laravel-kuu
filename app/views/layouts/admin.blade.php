<!DOCTYPE html>
<html lang='en'>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>@yield('title') |  trans('layouts.user_admin') </title>
<!--
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
-->

    @stylesheets( 'admin')
    @javascripts('bootstrap_js')

    <style>
        body {
            margin-top: 1%;
        }
        .nomrg{margin:0px 0px 0px;}
    </style>
</head>
<body>

<div class="row-fluid">
    <div class="span1">&nbsp;</div>
        @yield('content')
    <div class="span1">&nbsp;</div>
</div>
</body>
</html>