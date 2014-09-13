@extends('dashboard.index')

@section ('getgraphdataform')

	{{ Form::open( array(
		'url' => URL::route('getgraphdatawalkthrough', array('lang' =>App::getLocale())),
		'method' => 'post',
		'class' => 'hide',
		'id' => 'getgraphdataform'
	) ) }}
		<input type="hidden" id="report_mongo_id" name="report_mongo_id" value=""/>
		<input type="hidden" id="check_report_period" name="check_report_period" value=""/>
		<input type="hidden" id="report_check_id" name="report_check_id" value=""/>
	{{ Form::close() }}

@show

@section ('walkthrough')

<!--
	<link rel="stylesheet" href="{{ asset('assets/css/dashboard.pagewalkthrough.css') }}">

	<script src="{{ asset('assets/js/jquery.pagewalkthrough-1.1.0.js') }}"></script>
	<script src="{{ asset('assets/js/settings.pagewalkthrough.js') }}"></script>
-->
@stylesheets( 'walkthrough')
@javascripts('walkthrough_js')

	<div id="walkthrough">
		<div id="wt-step-0" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<!-- <div class="tooltip_arrow"></div> -->
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t1') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t1') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t1') }}</p>
					<p class='tooltip_body_text tooltip_body_message'>{{ trans('dashboard.tt_body_text.t2') }}</p></div>
				<div class="tooltip_container_footer">
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-1" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t2') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t2') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t3') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t4') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-2" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t3') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t3') }}</p>
					<div class='tooltip_body_list'>
						<div class='list_term'>{{ trans('dashboard.tt_body_text.list.t1') }}</div>
						<div class='list_definition'>{{ trans('dashboard.tt_body_text.list.d1') }}</div>
					</div>
					<div class='tooltip_body_list'>
						<div class='list_term'>{{ trans('dashboard.tt_body_text.list.t2') }}</div>
						<div class='list_definition'>{{ trans('dashboard.tt_body_text.list.d2') }}</div>
					</div>
					<div class='tooltip_body_list'>
						<div class='list_term'>{{ trans('dashboard.tt_body_text.list.t3') }}</div>
						<div class='list_definition'>{{ trans('dashboard.tt_body_text.list.d3') }}</div>
					</div>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-3" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t4') }}	
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t4') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t5') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t6') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-4" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t5') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t5') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t7') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t8') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="see_details" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-5" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t6') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t6') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t9') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t10') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-6" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t7') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t7') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t11') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t12') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-7" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t8') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t8') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t13') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t14') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-8" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t9') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t9') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t15') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="tooltip_next" href="javascript:;">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.next') }}&#9656</b></a>
				</div>
			</div>
		</div>
		<div id="wt-step-9" class="tooltip_container_wrapper">
			<div class="tooltip_container">
				<div class="tooltip_arrow"></div>
				<a class="tooltip_close" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}"></a>
				<div class="tooltip_container_header">
					<div class="tooltip_icon"></div>
					<div class="tooltip_title">
						{{ trans('dashboard.tt_title.t10') }}
					</div>
				</div>
				<div class="tooltip_container_body">
					<p class='tooltip_body_title'>{{ trans('dashboard.tt_body_title.t10') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t16') }}</p>
					<p class='tooltip_body_text'>{{ trans('dashboard.tt_body_text.t17') }}</p>
				</div>
				<div class="tooltip_container_footer">
					<a class="tooltip_prev" href="javascript:;">{{ trans('dashboard.back') }}</a>
					<a class="close_step" href="{{ URL::route('dashboard',array('lang' =>App::getLocale())) }}">{{ trans('dashboard.ok_got_it') }} <b>{{ trans('dashboard.finish') }}</b></a>
				</div>
			</div>
		</div>		
	</div>
@stop