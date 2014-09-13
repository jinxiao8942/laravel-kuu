<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>{{ trans('main.terms_of_use') }}</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:100,100Italic,300,300Italic,500,500Italic,700,700Italic,900,900Italic' />
	
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/metro.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-responsive.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style_responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style_default.css') }}">

	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	@include('dashboard/topmenu')
	<div id="main-page-container">
		<div class="beta-container terms-of-use">
			{{ trans('main.termsofusetext') }}
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	@include('dashboard/footer')
	
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>