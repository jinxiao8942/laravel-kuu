<div id="main-header-hav">
	<div class="beta-container">
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN LOGO -->
				<a  class="brand" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo" /></a>
				<!-- END LOGO -->

				<div class="navbar navbar-inverse header-menu" style="display: inline;">
					<div class="navbar-inner">
						<div class="container"> 
							<ul class="nav">
								@if (Sentry::check() && Sentry::getUser()->hasAccess('admin.users'))
								<li><a href="{{URL::route('admin.user',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.administration') }}</a></li>
								@endif

								<li><a href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.dashboard') }}</a></li>

								<li class="parent-menu-item subitem-left">
									<a href="{{ URL::route('account',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.account') }}</a>
									<ul>
										<li><a href="{{ URL::route('account',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.account_settings') }}</a></li>
										<li><a href="{{ URL::route('logout',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.log_out') }}</a></li>
									</ul>
								</li>

								<li class="parent-menu-item subitem-right">
									<a href="{{ URL::route('contact-support',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.help') }}</a>
									<ul>
										<li><a href="{{ URL::route('walkthrough',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.walkthrough') }}</a></li>
										<li><a href="{{ URL::route('contact-support',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.contact_support') }}</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>