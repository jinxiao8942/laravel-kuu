<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		@section('title') 
		@show 
	</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="favicon.ico" />
	
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:100,100Italic,300,300Italic,500,500Italic,700,700Italic,900,900Italic' />
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:100,100Italic,300,300Italic,500,500Italic,700,700Italic,900,900Italic' />
	
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/metro.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">
<!--
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/jquery.scrollTo-min.js') }}"></script>
	<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/uniform/jquery.uniform.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.blockui.js') }}"></script>
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.backstretch.min.js') }}"></script>
-->
</head>
<body>
<div class="header">
	<div class="wrap clear">
		<span class="icons logo"></span>
		<div class="button_wrap">
			<?php /*
			@if (Sentry::check())			
			<a href="/users/{{ Session::get('userId') }}" class="button green"><span {{ (Request::is('users/show/' . Session::get('userId')) ? 'class="active"' : '') }} >{{ Session::get('email') }}</span></a>
			<a href="{{ URL::to('dashboard') }}" class="button green"><span>Dashboard</span></a>
			<a href="{{ URL::to('logout') }}" class="button green"><span>Logout</span></a>
			@else
			<a href="{{ URL::to('login') }}" class="button green"><span {{ (Request::is('login') ? 'class="active"' : '') }} >Login to My Account</span></a>
			<a href="{{ URL::to('users/create') }}" class="button green"><span {{ (Request::is('users/create') ? 'class="active"' : '') }} >Register</span></a>
			@endif
			*/ ?>
			<ul class="header-nav-left-item pull-right">
				@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
				<li {{ (Request::is('users*') ? 'class="active"' : '') }}><a class="btn green" href="{{ URL::to('/users') }}">{{ trans('main.users') }}</a></li>
				<li {{ (Request::is('groups*') ? 'class="active"' : '') }}><a class="btn green" href="{{ URL::to('/groups') }}">{{ trans('main.groups') }}</a></li>
				@endif
			</ul>
			<ul class="header-nav-left-item pull-right">
				@if (Sentry::check())
                    @if (Sentry::getUser()->hasAccess('admin.users'))
                        <li><a class="btn yellow" href="{{ URL::route('admin.user',array('lang' =>App::getLocale())) }}">{{ trans('main.administration') }}</a></li>
                    @endif
				<li {{ (Request::is('users/show/' . Session::get('userId')) ? 'class="active"' : '') }}><a class="btn green" href="/users/{{ Session::get('userId') }}">{{ Session::get('email') }}</a></li>
				<li><a class="btn green" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}">{{ trans('main.dashboard') }}</a></li>
				<li><a class="btn green" href="{{ URL::route('logout',array('lang' =>App::getLocale())) }}">{{ trans('main.logout') }}</a></li>
				@else
				<li {{ (Request::is('login') ? 'class="active"' : '') }}><a class="btn green" href="{{ URL::route('login',array('lang' =>App::getLocale())) }}">{{ trans('main.login') }}</a></li>
				<li {{ (Request::is('users/create') ? 'class="active"' : '') }}><a class="btn green" href="{{ URL::route('users.create',array('lang' =>App::getLocale())) }}">{{ trans('main.register') }}</a></li>
				@endif
			</ul>
		</div>
	</div>
	<div class="line"></div>
</div>
<!-- Notifications -->
@include('layouts/notifications')
<!-- ./ notifications -->

<div id='block0' class="banner section">
	<div class="wrap clear">
		<h1 id="typeahead">{{ trans('main.keepyoursite') }}</h1>
		<p>{{ trans('main.monitor') }}</p>
		<h2>{{ trans('main.wantmore') }}</h2>
		<div class="button_wrap clear">
			<div class="col six align-right"><a id="btn_works" class="button orange"><span>{{ trans('main.how_it_works') }}</span></a></div>
			<div class="col six align-left"><a id="btn_plans" class="button green"><span>{{ trans('main.pricing_plans') }}</span></a></div>
		</div>
	</div>
</div>

<div id='block1' class="agreement section">
	<div class="wrap clear">
		<div class="title">
			{{ trans('main.welcometokuu') }}
		</div>
		<div class="line"></div>
		<div class="col four">
			<div class="icons service"></div>
			{{ trans('main.servicetext') }}
		</div>
		<div class="col four">
			<div class="icons experts"></div>
			{{ trans('main.expertstext') }}
		</div>
		<div class="col four">
			<div class="icons fees"></div>
			{{ trans('main.feestext') }}
		</div>
	</div>
</div>
<div id='block2' class="workflow section">
	<div class="wrap clear">
		<h2>{{ trans('main.howsysworks') }}</h2>
		<div class="row_wrap">
			<div class="row clear align-left row1">
				<div class="icons num"><div>1</div></div>
				<div class="col five icon">
					<div class="icons icon1"></div>
				</div>
				<div class="col five txt">
					<span class="icons arrow"></span>
					{{ trans('main.monitortext') }}
				</div>
			</div>
			<div id="row_alert" class="row clear align-right row2">
				<div class="icons num"><div>2</div></div>
				<div class="col five txt">
					<span class="icons arrow"></span>
					{{ trans('main.alerttext') }}
				</div>
				<div class="col five icon">
					<div class="icons icon2"></div>
				</div>
			</div>
			<div class="row clear align-left row3">
				<div class="icons num"><div>3</div></div>
				<div class="col five icon">
					<div class="icons icon3"></div>
				</div>
				<div class="col five txt">
					<span class="icons arrow"></span>
					{{ trans('main.helptext') }}
				</div>
			</div>
			<div id="gotop" class="row clear align-left last">
				<div class="icons num">
					<span class='icons rocket'></span>
				</div>
			</div>
			<div class="line"></div>
		</div>
		<div class="button_wrap clear">
			<div class="col six align-right"><a class="btn_plans button red"><span>{{ trans('main.pricing_plans') }}</span></a></div>
			<div class="col six align-left"><a id="btn_contact" class="button green"><span>{{ trans('main.contact_us') }}</span></a></div>
		</div>
	</div>
</div>
<div id='block3' class="price section">
	<div class="wrap clear">
		<div class="col seven">
			{{ trans('main.trialpackage') }}
			<form>
				<input type="text" value="{{ trans('main.emailgoeshere') }}"/>
				<div class="button_wrap clear">
					<a href="#" class="button red"><span>{{ trans('main.subscribe_now') }}</span></a>
				</div>
			</form>
		</div>
		<div class="col five">
			<div class="list_wrap">
				<ul>
					{{ trans('main.traillist') }}
					<li class="last"><a href="#" class="button red"><span>{{ trans('main.start_trial') }}</span></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id='block4' class="contact section">
	<div class="wrap clear">
		<h2>{{ trans('main.relaxandenjoy') }}</h2>
		<div class="col seven">
			<form>
				<h3>{{ trans('main.knowmore') }}</h3>
				<ul>
					<li><input type="text" value="{{ trans('main.yourname') }}" /></li>
					<li><input type="text" value="{{ trans('main.youremail') }}" /></li>
					<li><textarea>{{ trans('main.wanttoknow') }}</textarea></li>
					<li class="align-right"><a href="#" class="button red"><span>{{ trans('main.send_away') }}</span></a></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<div id='block5' class="footer section">
	<div class="wrap clear">
		<div class="col eight"><p>Copyright &copy; 2014 KeepUsUp.com. {{ trans('main.all_rights_reserved') }}</p></div>
		<div class="col four align-right" style="display:none;">
			<ul>
				<li><div class="icons icon1"></div></li>
				<li><div class="icons icon2"></div></li>
				<li><div class="icons icon3"></div></li>
				<li><div class="icons icon4"></div></li>
				<li><div class="icons icon5"></div></li>
			</ul>
		</div>
	</div>
</div>

@javascripts('login_js')
<script src="{{ asset('js/jquery.scrollTo-min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.backstretch.min.js') }}"></script>
<script language="javascript">
	$("#block0").backstretch("{{ asset('images/banner_bg.jpg') }}");
	$("#block3").backstretch("{{ asset('images/price_bg.jpg') }}");
	$("#block4").backstretch("{{ asset('images/contact_bg.jpg') }}");
	var characterPosition;

	function msgChange(id) {
		characterPosition=0;
		var msg = $('#'+id).html();
		typeaheadText(id, msg);
	}

	function typeaheadText(id, msg) {
		var cursor = '<span id="typed-cursor">|</span>';
		if(characterPosition === 0) {
			$('#'+id).html(cursor);
			timeoutID = window.setTimeout(function(){ typeaheadText(id, msg) }, 1000);
			++characterPosition;
			return;
		}
		var text = msg.slice(0, characterPosition);
		++characterPosition;
		if(text !== msg){
			$('#'+id).html(text + cursor);
		}else{
			$('#'+id).html(text);
			return;
		}

		timeoutID = window.setTimeout(function(){ typeaheadText(id, msg) }, 50);
	}

	var triggers = [
		{"btop" : $(".agreement").offset().top, "flag": false},
		{"btop" : $(".workflow").offset().top, "flag": false},
		{"btop" : $(".price").offset().top, "flag": false},
		{"btop" : $(".contact").offset().top, "flag": false},
	];

	var wh = $(window).height() * 0.66;
	$( window ).resize(function() {
		wh = $(window).height() * 0.66;
	});

	$( window ).scroll(function() {
		var scroll_top = window.pageYOffset;

		$.each( triggers, function( key, value ) {
			var block_top_pos = value.btop - scroll_top;
			if (block_top_pos < wh && !value.flag) {
				value.flag = true;
			}
		});
	});

	jQuery(document).ready(function() {
		msgChange('typeahead');

		App.initLogin();

		jQuery(".banner a.button,.workflow a.button,.workflow .num,.agreement .icons").hover(
			function(){jQuery(this).parent().addClass("active");},
			function(){jQuery(this).parent().removeClass("active");}
		);
		jQuery('#btn_works').click(function(){
			jQuery.scrollTo('.workflow',600,{offset:{top:-50,left:0}});
		});
		jQuery('.btn_plans').click(function(){
			jQuery.scrollTo('.price',600,{offset:{top:-50, left:0}});
		});
		jQuery('#btn_contact').click(function(){
			jQuery.scrollTo('.contact',600,{offset:{top:-50, left:0}});
		});
	});
</script>
</body>
</html>