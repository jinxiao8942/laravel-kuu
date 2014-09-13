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
<!--
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
-->
    @javascripts('bootstrap_js')
</head>
<body class="dashboard-home">
	@include('dashboard/topmenu')
	<div id="main-page-container">
		<div class="beta-container">
			<div id="dashboard">
				<div class="row-fluid content-header">
					<div class="span12">
						<div class="pull-left">
							<h3>{{ trans('dashboard.dashboard') }}</h3>
						</div>
						<div id="wt-target-1" class="add-site-section pull-right {{ $is_add_enable ? '' : 'hide' }}">
							<a href="#" id="add_site_btn" class="pull-right open_inner_page" main_id="dashboard" modal_id="contact-support-add-another-site">{{ trans('dashboard.add_site') }}</a>
							<p class="pull-right add-site-description" style="width: 140px;">{{ trans('dashboard.anothersite') }}</p>
						</div>
						<div id="add-limit-message-section" class="limit-create-check alert alert-error {{ $is_add_enable ? 'hide' : '' }}">
							<strong>{{ trans('dashboard.maxchecks') }}</strong>
						</div>
					</div>
				</div>
				<div id="dashboard-section-mask"></div>

				<div id="check-list">
                    @include('dashboard/check-list')
				</div>
				<div class="clearfix h10"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		@include('dashboard/innerdialog')
		<div class="clearfix"></div>
		<div id="graph-section-bar" class="hide">
			<div id="graph_drawing_progress" class=""></div>
			<div id="dashboard-graph-header">
				<div id="dashboard-graph-header-inner" class="beta-container">
					<span>{{ trans('dashboard.details_for') }}</span>
					<div class="clearfix"></div>
					<h5 id="graph-title"></h5>
					<a href="#" class="pull-right" id="graph-section-close"><img src="{{ asset('assets/img/remove-kuu-close.png') }}"/></a>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="dashboard-graph-page-list">
				<div class="beta-container">
					<div class="graph-page-list-items">
					</div>
					<div class="clearfix"></div>
					<a href="#" class="graph-page-prev"></a>
					<a href="#" class="graph-page-next"></a>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="dashboard-graph-page-content" class="hide">
				<div class="beta-container">
					<div id='date-selector'>
						<select id="check_report_period_select" class="hide">
							<option value="day">{{ trans('dashboard.day') }}</option>
							<option value="week" selected="selected">{{ trans('dashboard.week') }}</option>
							<option value="month">{{ trans('dashboard.month') }}</option>
							<option value="months">{{ trans('dashboard.months') }}</option>
						</select>
						<div class="graph-date-selection">
							<ul class="graph-time-stamp">
								<li class="select-time-stamp" combo-val="day" workday="1"><a href="#">{{ trans('dashboard.day') }}</a></li>
								<li combo-val="week" workday="7"><a href="#">{{ trans('dashboard.week') }}</a></li>
								<li combo-val="month" workday="28"><a href="#">{{ trans('dashboard.month') }}</a></li>
								<li combo-val="months" workday="90"><a href="#">{{ trans('dashboard.months') }}</a></li>
							</ul>
							<span class="graph-date-range"></span>
							<div class="clearfix"></div>
						</div>
						<div class="uptimebar-section">
							<div class="uptimebar-graph"></div>
							<div class="uptimebar-graph-label"></div>
						</div>
					</div>

					<div id='graph-area'>
						<ul class="data-selection-list">
							<li class="showing-type select-data-item" type="Availability">
								<div>{{ trans('dashboard.availability') }}</div>
								<div id="availability_value" class="value"></div>
							</li>
							<li class="showing-type" type="Downtime">
								<div>{{ trans('dashboard.downtime') }}</div>
								<div id="downtime_value" class="value"></div>
							</li>
							<li class="showing-type" type="Response Time">
								<div>{{ trans('dashboard.response_time') }}</div>
								<div id="response_time_value" class="value"></div>
							</li>
							<li class="showing-type" type="Responsiveness">
								<div>{{ trans('dashboard.responsiveness') }}</div>
								<div id="responsiveness_value" class="value"></div>
							</li>
							<!--li class="data-selection-list-btn">
								<a href="#" id="data-selection-list-suspend-btn">Suspend</a>
							</li//-->
							<!--li class="data-selection-list-btn">
								<a href="#" id="data-selection-list-edit-btn">Edit</a>
							</li//-->
						</ul>
						<div class="clearfix"></div>
						<div id="container" style="min-width: 310px; height: 400px; margin: 45px auto 0"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div id="notification-email-content">
				<div id="notification-email-content-inner" class="beta-container">
					<h5>{{ trans('dashboard.notification_emails') }}
						<a href="#" class="data-selection-remove-btn hide" id="data-selection-list-unsuspend-btn">{{ trans('dashboard.unsuspend') }}</a>
						<a href="#" class="data-selection-remove-btn hide" id="data-selection-list-delete-btn">{{ trans('dashboard.delete') }}</a>
						<a href="#" class="data-selection-remove-btn" id="data-selection-list-suspend-btn">{{ trans('dashboard.suspend') }}</a>
						<a href="#" id="data-selection-list-edit-btn">{{ trans('dashboard.edit') }}</a>
					</h5>
					<ul id="detail_notification_email">
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer-page-container">
		<div class="beta-container">
			<div class="row-fluid">
				<div class="span12">
					<span>&copy; 2014 KeepUsUp.com. {{ trans('dashboard.all_rights_reserved') }}</span>
					<span class="pull-right text-right">
						<a href="{{ URL::route('privacy-policy',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.privacy_policy') }}</a> | <a href="{{ URL::route('terms-of-use',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.terms_of_use') }}</a>
					</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<script type="text/javascript">
		var confirm_text = {
			'suspendcheck'	: "{{ trans('main.confirmsuspendcheck') }}",
			'unsuspendcheck': "{{ trans('main.confirmunsuspendcheck') }}",
			'delete_c'		: "{{ trans('main.confirmdeletecheck') }}"
		};
	</script>

@section ('getgraphdataform')

	{{ Form::open( array(
		'url' => URL::route('getgraphdata', array('lang' =>App::getLocale())),
		'method' => 'post',
		'class' => 'hide',
		'id' => 'getgraphdataform'
	) ) }}
        <input type="hidden" id="user_id" name="user_id" value="{{ Sentry::getUser()->id }}">
		<input type="hidden" id="report_mongo_id" name="report_mongo_id" value=""/>
		<input type="hidden" id="check_report_period" name="check_report_period" value=""/>
		<input type="hidden" id="report_check_id" name="report_check_id" value=""/>
	{{ Form::close() }}

@show
	
	{{ Form::open( array(
		'url' => URL::route('checksite.suspendcheck', array('lang' =>App::getLocale())),
		'method' => 'post',
		'class' => 'hide',
		'id' => 'suspendcheckform'
	) ) }}
		<input type="hidden" id="suspend_check_id" name="suspend_check_id" value=""/>
		<input type="hidden" id="suspend_mongo_id" name="suspend_mongo_id" value=""/>
		<input type="hidden" id="suspend_is_paused" name="suspend_is_paused" value=""/>
	{{ Form::close() }}
	
	{{ Form::open( array(
		'url' => URL::route('checksite.deletecheck', array('lang' =>App::getLocale())),
		'method' => 'post',
		'class' => 'hide',
		'id' => 'deletecheckform'
	) ) }}
		<input type="hidden" id="del_check_id" name="del_check_id" value=""/>
		<input type="hidden" id="del_mongo_id" name="del_mongo_id" value=""/>
	{{ Form::close() }}
	
	{{ Form::open( array(
		'url' => URL::route('checksite.refresh', array('lang' =>App::getLocale())),
		'method' => 'post',
		'class' => 'hide',
		'id' => 'checksiterefresh'
	) ) }}
	{{ Form::close() }}

<!--
	<script src="{{ asset('assets/js/highcharts.js') }}"></script>
	<script src="{{ asset('js/jquery.input-ip-address-control-1.0.min.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>
	<script src="{{ asset('assets/js/add_another_site.js') }}"></script>
	<script src="{{ asset('assets/js/site_more_info.js') }}"></script>	
-->
    @javascripts( 'dashboard_js')
	@yield('walkthrough')
</body>
</html>