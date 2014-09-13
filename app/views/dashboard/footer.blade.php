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