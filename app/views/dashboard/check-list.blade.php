@if( !count($check_list) )
    @include('dashboard/nocheck')
@endif

@if(Session::has('error_messages'))
    @foreach(Session::get('error_messages') as $error_message)
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert" ></button>{{ $error_message }}
    </div>
    @endforeach
@endif
<?php $index = 0; ?>
@foreach( $check_list as $domain => $datalist )
<?php $index++; ?>
<div class="domain-section" id="domain-section-<?php echo $index; ?>">
    <div class="row-fluid site-url-section">
        <div class="span12">
            <h5 id="site-url-section-<?php echo $index; ?>">{{ $domain }}</h5>
        </div>
    </div>
    <div class="clearfix"></div>
    @foreach( $datalist as $data )
    <div class="row-fluid site-data-section {{ $data['is_paused'] ? 'passed-checked' : '' }}"  id="check_row_{{ $data['check_id'] }}">
        <div class="row-fluid">
            <div class="span12 url-detail-title">
                <a href="{{ $data['url'] }}" target="_blank" class="{{ $data['type'] }}-label mytooltip bottom url-detail-title-<?php echo $index; ?>" data-tool="{{ strtoupper($data['type']) }}:&nbsp;&nbsp;{{ $data['url'] }}" checktype="{{ $data['type'] }}" mongoid="{{ $data['mongo_id'] }}" checkid="{{ $data['check_id'] }}" passday="{{ $data['passday'] }}" is_paused="{{ $data['is_paused'] }}">
					{{ $data['path'] }}
				</a>
            </div>
        </div>
        <div class="row-fluid">
            <div class="pull-left" style="width:47%;padding:0 1% 0 2%;">
                <div class="row-fluid">
                    <div>
						<span class="progress {{ $data['check_value']['uptime_progress_class'] or '' }}" style="display:block;">
							<span style="width: {{ $data['check_value']['uptime_progress_val'] or '0' }}%;" class="bar pull-right"></span>
						</span>
						<span class="task text-right">
							<span class="pull-right check-value-label">{{ trans('dashboard.availability') }}</span>
							<span class="pull-right check-value-data {{ $data['check_value']['uptime_progress_class'] or '' }}">
								{{ isset($data['check_value']['uptime']) ? $data['check_value']['uptime'] . '%' : trans('dashboard.data_not_available') }}
							</span>
							@if( isset($data['check_value']['uptime_warning']) && $data['check_value']['uptime_warning'] )
							<a href="{{ URL::action('ContactsController@contactSupportForCheck', [ $data['check_id']]); }}" class="pull-right fix-this-btn">{{ trans('dashboard.fix_this') }}</a>
							@endif
						</span>
                    </div>
                </div>
            </div>
            <div class="pull-right @if(isset($data['check_value']['response_speed_warning']))wt-helper-fix @endif" style="width:47%;padding:0 1% 0 2%;">
                <div class="row-fluid">
                    <div>
						<span class="progress {{ $data['check_value']['response_speed_progress_class'] or '' }}" style="display:block;">
							<span style="width: {{ $data['check_value']['response_speed'] or '0' }}%;" class="bar"></span>
						</span>
						<span class="task">
							<span class="check-value-label">{{ trans('dashboard.response_speed') }}</span>
							<span class="check-value-data {{ $data['check_value']['response_speed_progress_class'] or '' }}">
								{{ isset($data['check_value']['response_speed_text']) ? $data['check_value']['response_speed_text'] : trans('dashboard.data_not_available') }}
							</span>
							@if( isset($data['check_value']['response_speed_warning']) &&   $data['check_value']['response_speed_warning'] )
							<a href="{{ URL::action('ContactsController@contactSupportForCheck', [ $data['check_id']]); }}" class="fix-this-btn">{{ trans('dashboard.fix_this') }}</a>
							@endif
						</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="clearfix"></div>
    <div class="row-fluid detail-section">
        <div class="span12">
            <a class="see_detail_btn" href="" data-index="<?php echo $index; ?>">{{ trans('dashboard.see_details') }}</a>
        </div>
    </div>
</div>
@endforeach