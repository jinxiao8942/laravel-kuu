<div class="page-sidebar nav-collapse collapse">
	<div class="note-book-stle">
		<h2>{{ trans('dashboard.anothersite') }}</h2>
		<p>{{ trans('dashboard.kickstart') }}</p>
		<a href="#" class="open_inner_page btn green" main_id="dashboard" modal_id="contact-support-add-another-site">{{ trans('dashboard.add_another_site') }}</a>
	</div>
	<div class="alert-sidebar">
		<div><h5>{{ trans('dashboard.sentalerts') }}</h5></div>
		<div>
			<a href="mailTo:{{ $useremail }}" class="sidebar-email">{{ $useremail }}</a>
			<p></p>
			@foreach ($usealertemail as $item)
			@if( $item->activated == 1 )
			<a href="mailTo:{{ $item->alertemail }}" class="sidebar-email">{{ $item->alertemail }}</a>
			<p></p>
			@endif
			@endforeach
		</div>
		<div><a href="{{ URL::route('account',array('lang' =>App::getLocale())) }}" class="change-setting">{{ trans('dashboard.change_settings') }}</a></div>
	</div>
</div>