<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>{{ trans('dashboard.dashboard') }}</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:100,100Italic,300,300Italic,500,500Italic,700,700Italic,900,900Italic' />
<!--
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/metro.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-responsive.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style_responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style_default.css') }}">
-->
    @stylesheets('bootstrap', 'dashboard')

	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body class="dashboard-home">
	@include('dashboard/topmenu')
	<div id="main-page-container">
		<div id="contact-support" class="inner_page_dlg">
			<div id="contact-support-header">
				<div class="beta-container">
					<div class="row-fluid">
						<div class="span12">
							<h1>{{ trans('dashboard.contact_support') }}</h1>
							<a href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}" class="close" main_id="dashboard" modal_id="contact-support">&nbsp;</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="beta-container" id="contact-support-inner">
				<div id="contact-support-page-info" class="row-fluid hide">
					<div class="span12">
						<div class="alert alert-info">
							<p>{{ trans('dashboard.confmessage') }}</p>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						{{ Form::open( array(
							'url' => URL::route('contacts.send',array('lang' =>App::getLocale())),
							'method' => 'post',
							'id' => 'contacts-support-page'
						) ) }}
							<input type="hidden" name="user-group" value="{{ $usergroup }}" />
							<div class="contact-parameter-section">
								<label>{{ trans('dashboard.name') }}</label>
								<input type="text" class="m-wrap" name="name" value="{{ $first_name }} {{ $last_name }}">
								<label>{{ trans('dashboard.email') }}</label>
								<input type="email" class="m-wrap" name="email" value="{{ $useremail }}">
								<label>{{ trans('dashboard.category') }}</label>
								<select class="m-wrap" name="category">
									<option value="Support">{{ trans('dashboard.support') }}</option>
									<option value="Billing">{{ trans('dashboard.billing') }}</option>
									<option value="Sales">{{ trans('dashboard.sales') }}</option>
									<option value="Other">{{ trans('dashboard.other') }}</option>
								</select>
								<label>{{ trans('dashboard.message') }}</label>
								<textarea class="m-wrap" name="message" style="height:200px;">{{ $standard_message }}</textarea>
								<div class="clearfix"></div>
								<!--a href="#" class="btn yellow pull-left close_inner_page" main_id="dashboard" modal_id="contact-support">GO BACK</a//-->
								<button type="submit" class="add_check_btn">{{ trans('dashboard.send') }}</button><img id="waiticon" class="pull-right hide" src="{{ asset('assets/img/fancybox_loading.gif') }}" style="margin-right:20px;"/>
							</div>
							<div class="contact-info-section">
								<h1>{{ trans('dashboard.contact_info.p1') }}</h1>

								<p>{{ trans('dashboard.contact_info.p2') }}</p> 

								<p>{{ trans('dashboard.contact_info.p3') }}</p>
								
								<h1>{{ trans('dashboard.contact_info.p4') }}</h1>

								<p>{{ trans('dashboard.contact_info.p5') }}</p>

								<p>{{ trans('dashboard.contact_info.p6') }}</p>

								<p>{{ trans('dashboard.contact_info.p7') }} <a href="mailto:support@keepusup.com">support@keepusup.com</a></p>
							</div>
							<div class="clearfix"></div>
							<p></p>
						{{ Form::close() }}	 		
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	@include('dashboard/footer')
<!--
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>
-->
    @javascripts('jquery_main_js')

</body>
</html>