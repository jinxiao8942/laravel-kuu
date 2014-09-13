<div class="clearfix"></div>
<div id="contact-support-add-another-site" class="inner_page_dlg hide">
	<div id="contact-support-add-another-site-header">
		<div class="beta-container">
			<div class="row-fluid">
				<div class="span12">
					<h1>{{ trans('dashboard.anothersite') }}</h1>
					<a href="#" id="add_another_site_close_btn" class="close close_inner_page" main_id="dashboard" modal_id="contact-support-add-another-site">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>
	<div class="beta-container">
		<div class="clearfix"></div>
		<div class="row-fluid">
			<div class="span1">
			</div>
			<div class="span10">
				<h5>{{ trans('dashboard.modeselect') }}</h5>
				<br/>
				<div class="clearfix"></div>
				<div class="row-fluid">
					<div class="span6 add-another-site-btn-section">
						<div class="add-site-setting-dlg-auto">
							<img src="{{ asset('assets/img/auto-check.png') }}"/>
							<h5>{{ trans('dashboard.auto_check_creation') }}</h5>
							<p>{{ trans('dashboard.autocreatechecks') }}</p>
							<a href="#" id="auto-check-creation-btn" main_id="dashboard" modal_id="contact-support-auto-mode" class="open_inner_page">{{ trans('dashboard.select_mode') }}</a>
						</div>
					</div>
					<div class="span6 add-another-site-btn-section">
						<div class="add-site-setting-dlg-manual">
							<img src="{{ asset('assets/img/mannual-check.png')}}"/>
							<h5>{{ trans('dashboard.manual_check_creation') }}</h5>
							<p>{{ trans('dashboard.abilitycreatechecks') }}</p>
							<a href="#" id="manual-check-creation-btn" main_id="dashboard" modal_id="contact-support-manual-mode" class="open_inner_page">{{ trans('dashboard.select_mode') }}</a>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="span1">
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div id="contact-support-auto-mode" class="inner_page_dlg hide">
	<div id="auto_add_insert_progress" class="hide"></div>
	<div id="contact-support-manual-mode-header">
		<div class="beta-container">
			<div class="row-fluid">
				<div class="span12" style="text-align:center;">
					<h1>{{ trans('dashboard.add_site') }}</h1>
					<h1 class="auto_check_creation_header">{{ trans('dashboard.auto_check_creation') }}</h1>
					<a href="#" class="close close_inner_page" main_id="contact-support-add-another-site" modal_id="contact-support-auto-mode">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="beta-container" id="auto_manual_mode_param">
		<div class="row-fluid">
			<div id="add_auto_site_info_duplicate" class="alert hide">{{ trans('dashboard.siteexist') }}</div>
			{{ Form::open( array(
				'url' => URL::route('checksite.addsiteinfoauto', array('lang' =>App::getLocale())),
				'method' => 'post',
				'id' => 'auto_setting_form'
			) ) }}
			<div class="row-fluid">
				<div class="span12">
                    <div id = "test_auto_alert_box">

                    </div>
					<div class="add_url_parameter_section">
						<div class="add_url_parameter_label_section">
							<h5>{{ trans('dashboard.enter_url') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="add_url_parameter_error_section">
							<div id="auto_url_error" class="hide">
								<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="add_url_parameter_input_section">
							<input data-action="{{URL::route('checksite.addsiteinfoauto')}}" id="site_auto_mode_url" type="text" name="url" class="m-wrap" placeholder="{{ trans('dashboard.example') }}: http://www.yahoo.com"/>
						</div>
					</div>
					<div class="clearfix h50"></div>

                    <div class="add_postbody_parameter_section">
                        <div class="add_url_parameter_label_section">
                            <h5>{{ trans('dashboard.postbody') }}</h5>
                        </div>
                        <div class="clearfix h10"></div>
                        <div class="add_url_parameter_error_section">
                            <div id="auto_url_error" class="hide">

                            </div>&nbsp;
                        </div>
                        <div class="add_url_parameter_input_section">
                            <textarea name="post_body" class="m-wrap" style="width: 436px" placeholder=""/>
                            </textarea>
                        </div>
                    </div>
                    <div class="clearfix h50"></div>

					<div class="add_notification_section">
						<div class="add_notification_label_section">
							<h5>{{ trans('dashboard.notification_emails') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="add_notification_error_section">
							<div id="auto_alert_email_err" class="hide">
								<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="add_notification_input_section">
							<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" name="auto_alert_email" id="auto_alert_email" value="" />
						</div>
						<div class="add_notification_btn_section">
							<input type="button" id="auto_add_alert_email" class="add_check_btn" value="{{ trans('dashboard.add_email') }}"/>
						</div>
					</div>
					<div class="check-alert-email-section">
						<ul id="auto_alert_list" class="check-alert-email-list"></ul>
						<ul class="user-account-email-list">
						@foreach ($usealertemail as $item)
							<li>
								<span class="pull-left">{{ $item->alertemail }}</span>
								<a class="remove_check_alert_email pull-right" href="#"><span class="small-close"></span></a>
								<input type="hidden" name="check_alert_email[]" value="{{ $item->alertemail }}" />
							</li>
						@endforeach
							<li>
								<span class="pull-left">{{ $useremail }}</span>
								<a href="#" class="remove_check_alert_email pull-right"><span class="small-close"></span></a>
								<input type="hidden" name="check_alert_email[]" value="{{ $useremail }}" />
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.create_check') }}" />
                    <input type="button" id="test_auto_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div id="contact-support-manual-mode" class="inner_page_dlg hide">
	<div id="manual_add_insert_progress" class="hide"></div>
	<div id="contact-support-manual-mode-header">
		<div class="beta-container">
			<div class="row-fluid">
				<div class="span12" style="text-align:center;">
					<h1>{{ trans('dashboard.add_site') }}</h1>
					<h1 class="manual_check_creation_header">{{ trans('dashboard.manual_check_creation') }}</h1>
					<a href="#" class="close close_inner_page" main_id="contact-support-add-another-site" modal_id="contact-support-manual-mode">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div id="contact-support-manual-mode-list">
		<div class="beta-container">
			<div class="row-fluid">
				<div class="span12">
					<div class="manual-page-list-items">
						<ul>
							<li class="select-page" parameterfield="http_parameter_field">
								<a href="" class="http-label">http</a>
							</li>
							<li parameterfield="https_parameter_field">
								<a href="" class="https-label">https</a>
							</li>
							<li parameterfield="dns_parameter_field">
								<a href="" class="dns-label">dns</a>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<a href="#" class="graph-page-prev"></a>
					<a href="#" class="graph-page-next"></a>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="beta-container add-another-site-form-section">
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<div class="span12">
						<div id="add_site_info_duplicate" class="alert hide">{{ trans('dashboard.siteexist') }}</div>
						<!--div id="add_site_info_success" class="alert alert-success hide">Successfully inserted.</div//-->
						<ul id="user-account-email-list-escape" class="hide user-account-email-list">
						@foreach ($usealertemail as $item)
							<li>
								<span class="pull-left">{{ $item->alertemail }}</span>
								<a class="remove_check_alert_email pull-right" href="#"><span class="small-close"></span></a>
								<input type="hidden" name="check_alert_email[]" value="{{ $item->alertemail }}" />
							</li>
						@endforeach
							<li>
								<span class="pull-left">{{ $useremail }}</span>
								<a href="#" class="remove_check_alert_email pull-right"><span class="small-close"></span></a>
								<input type="hidden" name="check_alert_email[]" value="{{ $useremail }}" />
							</li>
						</ul>
						<div id="http_parameter_field" class="parameter_section">
							{{ Form::open( array(
								'url' => URL::route('checksite.addsiteinfohttp', array('lang' =>App::getLocale())),
								'method' => 'post',
								'id' => 'manual_setting_form_http'
							) ) }}
							<div class="row-fluid">
                                <script language="javascript">
                                    $(function() {
                                        function test_check(params) {
                                            $('#test_' + params.action + params.type + '_alert_box').html('<div class="alert"><button type="button" class="close" data-dismiss="alert alert-primary" ></button>Please wait while data testing..</div>');
                                            $.getJSON( '{{URL::Route('checksite.testsiteinfo', array('lang' => App::getLocale()))}}', params)
                                        .done(function( data ) {
                                                var html_text = '';
                                                $.each( data.error_messages, function( i, error ) {
                                                    html_text +='<li>' + error + '</li>';
                                                });
                                                if(html_text)
                                                    $('#test_' + params.action + params.type + '_alert_box').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert" ></button><ul>' + html_text + '</ul></div>');
                                                if(data.success_message) {
                                                    $('#test_' + params.action + params.type + '_alert_box').html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" ></button>' + data.success_message + '</div>');
                                                }

                                            });
                                        }

                                        $("#test_http_check").click(function() {
                                            test_check({
                                                url: $("[name='http_url'").val(),
                                                phrases: $("[name='http_phrases']").val(),
                                                type: 'http',
                                                format: "json",
                                                action: ""
                                            });
                                        });

                                        $("#test_https_check").click(function() {
                                            test_check({
                                                url: $("[name='https_url'").val(),
                                                phrases: $("[name='https_phrases']").val(),
                                                type: 'https',
                                                action: "",
                                                format: "json"

                                            });
                                        });

                                        $("#test_edit_http_check").click(function() {
                                            test_check({
                                                url: $("#edit_http_url").val(),
                                                phrases: $("#edit_http_phrases").val(),
                                                type: 'http',
                                                action: "edit_",
                                                check_id:$("[name='check_id']").val(),
                                                format: "json"
                                            });
                                        });

                                        $("#test_edit_https_check").click(function() {
                                            test_check({
                                                url: $("#edit_https_url").val(),
                                                phrases: $("#edit_https_phrases").val(),
                                                type: 'https',
                                                action: "edit_",
                                                check_id:$("[name='check_id']").val(),
                                                format: "json"
                                            });
                                        });

                                        $("#test_edit_dns_check").click(function() {
                                            test_check({
                                                dns_host_name: $("#edit_dns_host_name").val(),
                                                dns_ip: $("#edit_dns_ip").val(),
                                                phrases: '',
                                                type: 'dns',
                                                action: "edit_",
                                                check_id:$("[name='check_id']").val(),
                                                format: "json"
                                            });
                                        });

                                        $("#test_dns_check").click(function() {
                                            test_check({
                                                dns_host_name: $("[name='dns_host_name'").val(),
                                                dns_ip: $("[name='dns_ip']").val(),
                                                phrases: '',
                                                type: 'dns',
                                                action: "",
                                                format: "json"
                                            });
                                        });

                                        $("#test_auto_check").click(function() {
                                            test_check({
                                                url: $("[name='url'").val(),
                                                phrases: '',
                                                type: 'auto',
                                                action: "",
                                                format: "json"
                                            });
                                        });

                                    });
                                </script>
								<div class="span12">
                                    <div id = "test_http_alert_box">

                                    </div>
									<div class="add_url_parameter_section">
										<div class="add_url_parameter_label_section">
											<h5>{{ trans('dashboard.enter_url') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_url_parameter_error_section">
											<div id="manual_http_url" class="hide">
												<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
												<div class="error-arrow"></div>
											</div>&nbsp;
										</div>
										<div class="add_url_parameter_input_section">
											<input type="text" placeholder="{{ trans('dashboard.example') }}: http://www.yahoo.com" class="m-wrap" name="http_url" value="" />
										</div>
									</div>
									<div class="add_other_parameter_section">
										<div class="add_other_parameter_label_section">
											<h5>{{ trans('dashboard.phrases_to_match') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_other_parameter_input_section">
											<input type="text" placeholder="{{ trans('dashboard.example') }}: Yahoo" class="m-wrap" name="http_phrases" value=""/>
										</div>
									</div>
									<div class="add_check_btn_section">
										<input type="button" class="add_check_btn hide" value="{{ trans('dashboard.add_check') }}" />
									</div>

                                    <div class="clearfix h50"></div>

                                    <div class="add_postbody_parameter_section" style="margin-left:220px">
                                        <div class="add_url_parameter_label_section">
                                            <h5>{{ trans('dashboard.postbody') }}</h5>
                                        </div>
                                        <div class="clearfix h10"></div>
                                        <div class="add_url_parameter_error_section">
                                            <div id="auto_url_error" class="hide">

                                            </div>&nbsp;
                                        </div>
                                        <div class="add_url_parameter_input_section">
                                            <textarea name="post_body" class="m-wrap" style="width: 436px" placeholder=""/>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix h50"></div>

									<div class="add_notification_section">
										<div class="add_notification_label_section">
											<h5>{{ trans('dashboard.notification_emails') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_notification_error_section">
											<div id="manual_http_alert_email_err" class="hide">
												<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
												<div class="error-arrow"></div>
											</div>&nbsp;
										</div>
										<div class="add_notification_input_section">
											<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" name="http_alert_email" id="http_alert_email" value="" />
										</div>
										<div class="add_notification_btn_section">
											<input type="button" class="add_check_btn" id="manual_http_add_alert_email" value="{{ trans('dashboard.add_email') }}"/>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="check-alert-email-section">
										<ul id="manual_http_alert_list" class="check-alert-email-list">
										</ul>
										<ul class="user-account-email-list">
										@foreach ($usealertemail as $item)
											<li>
												<span class="pull-left">{{ $item->alertemail }}</span>
												<a class="remove_check_alert_email pull-right" href="#"><span class="small-close"></span></a>
												<input type="hidden" name="check_alert_email[]" value="{{ $item->alertemail }}" />
											</li>
										@endforeach
											<li>
												<span class="pull-left">{{ $useremail }}</span>
												<a href="#" class="remove_check_alert_email pull-right"><span class="small-close"></span></a>
												<input type="hidden" name="check_alert_email[]" value="{{ $useremail }}" />
											</li>
										</ul>
									</div>
									<div class="clearfix"></div>

									<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.create_check') }}"/>
                                    <input type="button" id="test_http_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
								</div>
							</div>
							{{ Form::close() }}
						</div>
						<div id="https_parameter_field" class="parameter_section hide">
							{{ Form::open( array(
								'url' => URL::route('checksite.addsiteinfohttps', array('lang' =>App::getLocale())),
								'method' => 'post',
								'id' => 'manual_setting_form_https'
							) ) }}
							<div class="row-fluid">
								<div class="span12">
                                    <div id = "test_https_alert_box">

                                    </div>
									<div class="add_url_parameter_section">
										<div class="add_url_parameter_label_section">
											<h5>{{ trans('dashboard.enter_url') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_url_parameter_error_section">
											<div id="manual_https_url" class="hide">
												<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
												<div class="error-arrow"></div>
											</div>&nbsp;
										</div>
										<div class="add_url_parameter_input_section">
											<input type="text" placeholder="{{ trans('dashboard.example') }}: https://www.yahoo.com" class="m-wrap" name="https_url" value="" />
										</div>
									</div>
									<div class="add_other_parameter_section">
										<div class="add_other_parameter_label_section">
											<h5>{{ trans('dashboard.phrases_to_match') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_other_parameter_input_section">
											<input type="text" placeholder="{{ trans('dashboard.example') }}: Yahoo" class="m-wrap" name="https_phrases" value=""/>
										</div>
									</div>
									<div class="add_check_btn_section">
										<input type="button" class="add_check_btn hide" value="{{ trans('dashboard.add_check') }}">
									</div>
									<div class="clearfix h50"></div>

                                    <div class="add_postbody_parameter_section" style="margin-left:220px">
                                        <div class="add_url_parameter_label_section">
                                            <h5>{{ trans('dashboard.postbody') }}</h5>
                                        </div>
                                        <div class="clearfix h10"></div>
                                        <div class="add_url_parameter_error_section">
                                            <div id="auto_url_error" class="hide">

                                            </div>&nbsp;
                                        </div>
                                        <div class="add_url_parameter_input_section">
                                            <textarea name="post_body" class="m-wrap" style="width: 436px" placeholder=""/>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix h50"></div>

									<div class="add_notification_section">
										<div class="add_notification_label_section">
											<h5>{{ trans('dashboard.notification_emails') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_notification_error_section">
											<div id="manual_https_alert_email_err" class="hide">
												<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
												<div class="error-arrow"></div>
											</div>&nbsp;
										</div>
										<div class="add_notification_input_section">
											<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" id="https_alert_email" name="http_url" value="" />
										</div>
										<div class="add_notification_btn_section">
											<input type="button" id="manual_https_add_alert_email" class="add_check_btn" value="{{ trans('dashboard.add_email') }}"/>
										</div>
										<div class="check-alert-email-section">
											<ul id="manual_https_alert_list" class="check-alert-email-list">
											</ul>
											<ul class="user-account-email-list">
											@foreach ($usealertemail as $item)
												<li>
													<span class="pull-left">{{ $item->alertemail }}</span>
													<a class="remove_check_alert_email pull-right" href="#"><span class="small-close"></span></a>
													<input type="hidden" name="check_alert_email[]" value="{{ $item->alertemail }}" />
												</li>
											@endforeach
												<li>
													<span class="pull-left">{{ $useremail }}</span>
													<a href="#" class="remove_check_alert_email pull-right"><span class="small-close"></span></a>
													<input type="hidden" name="check_alert_email[]" value="{{ $useremail }}" />
												</li>
											</ul>
										</div>
									</div>
									<div class="clearfix"></div>
									<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.create_check') }}" />
                                    <input type="button" id="test_https_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
								</div>
							</div>
							{{ Form::close() }}
						</div>
						<div id="dns_parameter_field" class="parameter_section hide">
							{{ Form::open( array(
								'url' => URL::route('checksite.addsiteinfodns', array('lang' =>App::getLocale())),
								'method' => 'post',
								'id' => 'manual_setting_form_dns'
							) ) }}
							<div class="row-fluid">
								<div class="span12">
                                    <div id = "test_dns_alert_box">

                                    </div>
									<div class="add_url_parameter_section">
										<div class="add_url_parameter_label_section">
											<h5>{{ trans('dashboard.host_name') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_url_parameter_error_section">
											<div id="manual_dns_url" class="hide">
												<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
												<div class="error-arrow"></div>
											</div>&nbsp;
										</div>
										<div class="add_url_parameter_input_section">
											<input type="text" placeholder="{{ trans('dashboard.example') }}: www.yahoo.com" class="m-wrap" name="dns_host_name" value=""/>
										</div>
									</div>
									<div class="add_other_parameter_section">
										<div class="add_other_parameter_label_section">
											<h5>{{ trans('dashboard.ip_to_match') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_other_parameter_input_section">
											<input type="text" placeholder="{{ trans('dashboard.example') }}: xxx.xxx.xxx.xxx" class="m-wrap" name="dns_ip" value=""/>
										</div>
									</div>
									<div class="add_check_btn_section">
										<input type="button" class="add_check_btn hide" value="{{ trans('dashboard.add_check') }}">
									</div>
									<div class="clearfix h50"></div>
									<div class="add_notification_section">
										<div class="add_notification_label_section">
											<h5>{{ trans('dashboard.notification_emails') }}</h5>
										</div>
										<div class="clearfix h10"></div>
										<div class="add_notification_error_section">
											<div id="manual_dns_alert_email_err" class="hide">
												<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
												<div class="error-arrow"></div>
											</div>&nbsp;
										</div>
										<div class="add_notification_input_section">
											<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" name="http_url" id="dns_alert_email" value="" />
										</div>
										<div class="add_notification_btn_section">
											<input type="button" id="manual_dns_add_alert_email" class="add_check_btn" value="{{ trans('dashboard.add_email') }}"/>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="check-alert-email-section">
										<ul id="manual_dns_alert_list" class="check-alert-email-list">
										</ul>
										<ul class="user-account-email-list">
										@foreach ($usealertemail as $item)
											<li>
												<span class="pull-left">{{ $item->alertemail }}</span>
												<a class="remove_check_alert_email pull-right" href="#"><span class="small-close"></span></a>
												<input type="hidden" name="check_alert_email[]" value="{{ $item->alertemail }}" />
											</li>
										@endforeach
											<li>
												<span class="pull-left">{{ $useremail }}</span>
												<a href="#" class="remove_check_alert_email pull-right"><span class="small-close"></span></a>
												<input type="hidden" name="check_alert_email[]" value="{{ $useremail }}" />
											</li>
										</ul>
									</div>
									<div class="clearfix"></div>
									<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.create_check') }}" />
                                    <input type="button" id="test_dns_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
								</div>
							</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div id="edit-site-info" class="inner_page_dlg hide">
	<div id="edit-site-header">
		<div class="beta-container">
			<div class="row-fluid">
				<div class="span12" style="text-align:center;">
					<h1>{{ trans('dashboard.edit_check') }}</h1>
					<h1 class="edit_http_header">http</h1>
					<h1 class="edit_https_header hide">https</h1>
					<h1 class="edit_dns_header hide">dns</h1>
					<a href="#" id="add_another_site_close_btn" class="close close_inner_page" main_id="dashboard" modal_id="contact-support-add-another-site">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>
	<div class="beta-container" id="edit-site-info-param">
		<div class="clearfix"></div>
		<div class="row-fluid">
			<div id="site_edit_progress" class="hide"></div>
			<div class="span12">

				<div class="edit-http-section">
                    <div id = "test_edit_http_alert_box">

                    </div>
				{{ Form::open( array(
					'url' => URL::route('edithttpsiteinfoforedit', array('lang' =>App::getLocale())),
					'method' => 'post',
					'id' => 'edithttpsiteinfoforedit'
				) ) }}
					<input type="hidden" name="checkid" />
					<input type="hidden" name="mongoid" />
					<div class="edit_url_parameter_section">
						<div class="edit_url_parameter_label_section">
							<h5>{{ trans('dashboard.enter_url') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_error_section">
							<div id="edit_http_url_error" class="hide">
								<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="edit_url_parameter_input_section">
							<input type="text" id="edit_http_url" name="http_url" class="m-wrap" placeholder="{{ trans('dashboard.example') }}: http://www.yahoo.com">
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_label_section">
							<h5>{{ trans('dashboard.phrases_to_match') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_error_section">
							&nbsp;
						</div>
						<div class="edit_url_parameter_input_section">
							<input id="edit_http_phrases" name="http_phrases" type="text" class="m-wrap" placeholder="{{ trans('dashboard.example') }}: Yahoo">
						</div>
					</div>
					<div class="clearfix h50"></div>

                    <div class="add_postbody_parameter_section" style="margin-left:220px">
                        <div class="add_url_parameter_label_section">
                            <h5>{{ trans('dashboard.postbody') }}</h5>
                        </div>
                        <div class="clearfix h10"></div>
                        <div class="add_url_parameter_error_section">
                            <div id="auto_url_error" class="hide">

                            </div>&nbsp;
                        </div>
                        <div class="add_url_parameter_input_section">
                            <textarea name="post_body" class="m-wrap" style="width: 436px" placeholder=""/>
                            </textarea>
                        </div>
                    </div>
                    <div class="clearfix h50"></div>

					<div class="edit_notification_section">
						<div class="edit_notification_label_section">
							<h5>{{ trans('dashboard.notification_emails') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_notification_error_section">
							<div id="edit_http_alert_email_err" class="hide">
								<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="edit_notification_input_section">
							<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" name="edit_alert_email" value="" />
						</div>
						<div class="edit_notification_btn_section">
							<input type="button" id="edit_http_add_alert_email" class="add_check_btn" value="{{ trans('dashboard.add_email') }}" />
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="check-alert-email-section">
						<ul id="edit_http_alert_list" class="check-alert-email-list">
						</ul>
					</div>
					<div class="clearfix"></div>
					<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.save_changes') }}" />
                    <input type="button" id="test_edit_http_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
				{{ Form::close() }}
				</div>
				<div class="edit-https-section hide">
                    <div id = "test_edit_https_alert_box">

                    </div>
				{{ Form::open( array(
					'url' => URL::route('edithttpssiteinfoforedit', array('lang' =>App::getLocale())),
					'method' => 'post',
					'id' => 'edithttpssiteinfoforedit'
				) ) }}
					<input type="hidden" name="checkid" />
					<input type="hidden" name="mongoid" />
					<div class="edit_url_parameter_section">
						<div class="edit_url_parameter_label_section">
							<h5>{{ trans('dashboard.enter_url') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_error_section">
							<div id="edit_https_url_error" class="hide">
								<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="edit_url_parameter_input_section">
							<input type="text" id="edit_https_url" name="https_url" class="m-wrap" placeholder="{{ trans('dashboard.example') }}: http://www.yahoo.com">
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_label_section">
							<h5>{{ trans('dashboard.phrases_to_match') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_error_section">
							&nbsp;
						</div>
						<div class="edit_url_parameter_input_section">
							<input id="edit_https_phrases" name="https_phrases" type="text" class="m-wrap" placeholder="{{ trans('dashboard.example') }}: Yahoo">
						</div>
					</div>
					<div class="clearfix h50"></div>

                    <div class="add_postbody_parameter_section" style="margin-left:220px">
                        <div class="add_url_parameter_label_section">
                            <h5>{{ trans('dashboard.postbody') }}</h5>
                        </div>
                        <div class="clearfix h10"></div>
                        <div class="add_url_parameter_error_section">
                            <div id="auto_url_error" class="hide">

                            </div>&nbsp;
                        </div>
                        <div class="add_url_parameter_input_section">
                            <textarea name="post_body" class="m-wrap" style="width: 436px" placeholder=""/>
                            </textarea>
                        </div>
                    </div>
                    <div class="clearfix h50"></div>

					<div class="edit_notification_section">
						<div class="edit_notification_label_section">
							<h5>{{ trans('dashboard.notification_emails') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_notification_error_section">
							<div id="edit_https_alert_email_err" class="hide">
								<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="edit_notification_input_section">
							<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" name="edit_alert_email" value="">
						</div>
						<div class="edit_notification_btn_section">
							<input type="button" id="edit_https_add_alert_email" class="add_check_btn" value="{{ trans('dashboard.add_email') }}">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="check-alert-email-section">
						<ul id="edit_https_alert_list" class="check-alert-email-list">
						</ul>
					</div>
					<div class="clearfix"></div>
					<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.save_changes') }}" />
                    <input type="button" id="test_edit_https_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
				{{ Form::close() }}
				</div>
				<div class="edit-dns-section hide">
                    <div id = "test_edit_dns_alert_box">

                    </div>
				{{ Form::open( array(
					'url' => URL::route('editdnssiteinfoforedit', array('lang' =>App::getLocale())),
					'method' => 'post',
					'id' => 'editdnssiteinfoforedit'
				) ) }}
					<input type="hidden" name="checkid" />
					<input type="hidden" name="mongoid" />
					<div class="edit_url_parameter_section">
						<div class="edit_url_parameter_label_section">
							<h5>{{ trans('dashboard.host_name') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_error_section">
							<div id="edit_dns_url_error" class="hide">
								<div class="error-label">{{ trans('dashboard.invalidlink') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="edit_url_parameter_input_section">
							<input type="text" id="edit_dns_host_name" name="dns_host_name" class="m-wrap" placeholder="{{ trans('dashboard.example') }}: www.yahoo.com">
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_label_section">
							<h5>{{ trans('dashboard.ip_to_match') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_url_parameter_error_section">
							&nbsp;
						</div>
						<div class="edit_url_parameter_input_section">
							<input name="dns_ip" id="edit_dns_ip" type="text" class="m-wrap">
						</div>
					</div>
					<div class="clearfix h50"></div>
					<div class="edit_notification_section">
						<div class="edit_notification_label_section">
							<h5>{{ trans('dashboard.notification_emails') }}</h5>
						</div>
						<div class="clearfix h10"></div>
						<div class="edit_notification_error_section">
							<div id="edit_dns_alert_email_err" class="hide">
								<div class="error-label">{{ trans('dashboard.valid_email') }}</div>
								<div class="error-arrow"></div>
							</div>&nbsp;
						</div>
						<div class="edit_notification_input_section">
							<input type="text" placeholder="{{ trans('dashboard.email_address') }}" class="m-wrap" name="edit_alert_email" id="edit_alert_email" value="">
						</div>
						<div class="edit_notification_btn_section">
							<input type="button" id="edit_dns_add_alert_email" class="add_check_btn" value="{{ trans('dashboard.add_email') }}">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="check-alert-email-section">
						<ul id="edit_dns_alert_list" class="check-alert-email-list xxx1">
						</ul>
					</div>
					<div class="clearfix"></div>
					<input type="submit" class="add_check_btn create_check_btn" value="{{ trans('dashboard.save_changes') }}" />
                    <input type="button" id="test_edit_dns_check" style="margin: 70px 0 0 0; background-image: linear-gradient(to bottom, #07A71A 0%, #1E7702 100%);"  class="add_check_btn" value="{{ trans('dashboard.test_check') }}"/>
				{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
	{{ Form::open( array(
		'url' => URL::route('getsiteinfoforedit', array('lang' => App::getLocale())),
		'method' => 'post',
		'class' => 'hide',
		'id' => 'getsiteinfoforedit'
	) ) }}
		<input type="hidden" name="mongo_id" value=""/>
		<input type="hidden" name="check_id" value=""/>
	{{ Form::close() }}
</div>