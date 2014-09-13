@extends('layouts.admin')

@section('title')
{{ trans('admin.create_check') }}
@stop

@section('content')
<script language="javascript">
    jQuery(document).ready(function() {
        function show_options() {
            if($('[name = "edit_options"]').prop('checked')){
                $('#options_group').css('display', 'block');
                $('#phrases_group').css('display', 'none');
            }
            else {
                $('#options_group').css('display', 'none');
                $('#phrases_group').css('display', 'block');
            }
        }
        $('[name = "edit_options"]').click(function(){
           show_options();
        });

        function show_postbody() {
            if(!$('[name = "edit_options"]').prop('checked') && (($('[name = "type"]').val() == 'http') || ($('[name = "type"]').val() == 'https'))){
                $('#postbody_group').css('display', 'block');
            }
            else {
                $('#postbody_group').css('display', 'none');
            }
        }

        function show_host() {
            if($('[name = "type"]').val() == 'dns'){
                $('#host_group').css('display', 'block');
            }
            else {
                $('#host_group').css('display', 'none');
            }
        }

        $('[name = "edit_options"]').click(function(){
            show_options();
            show_postbody();
        });

        $('[name = "type"]').change(function() {
            show_host();
        });
        show_options();
        show_postbody();

        show_host();
    });
</script>

<div class="span10">

    <h1><i class='fa fa-edit'></i> {{ trans('admin.edit_check') }}</h1>

    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    @if(Session::has('error_messages'))
    <?php// $error_messages = Session::get('error_messages'); print_r($error_messages)?>
        @foreach(Session::get('error_messages') as $error_message)
        <p class="alert alert-danger">{{ $error_message }}</p>
        @endforeach
    @endif

    {{ Form::model($check, ['role' => 'form', 'url' => URL::route('admin.check', array('lang' =>App::getLocale())).'/'.$check->user_id . '/' . $check->check_id, 'method' => 'PUT', 'class' => 'form-horizontal']) }}

    <div class="control-group">
        {{ Form::label('url', trans('admin.url'),['class' => 'control-label']) }}
        <div class='controls'>
            {{ Form::url('url', null, ['placeholder' => trans('admin.url')]) }}
        </div>
    </div>

    <div class='control-group'>
        {{ Form::label('type', trans('admin.type'),['class' => 'control-label']) }}
        <div class='controls'>
            {{Form::select('type', array('http' => 'http', 'https' => 'https', 'dns' => 'dns'), $check->type)}}
        </div>    
    </div>

    <div id = "host_group" class='control-group'>
        {{ Form::label('host', trans('admin.host'),['class' => 'control-label']) }}
        <div class='controls'>
        {{ Form::text('host', null, ['placeholder' => trans('admin.host')]) }}
        </div>
    </div>

    <div class='control-group'>
        {{ Form::label('edit_options', trans('admin.edit_os'),['class' => 'control-label']) }}
        <div class='controls'>
            {{ Form::checkbox('edit_options', 'change') }}
        </div>
    </div>

    <div id = "phrases_group" class='control-group'>
        {{ Form::label('phrases', trans('admin.phrases'),['class' => 'control-label']) }}
        <div class='controls'>
            {{ Form::text('phrases', null, ['placeholder' => trans('admin.phrases_m')]) }}
        </div>
    </div>

    <div id = "postbody_group" class='control-group'>
        {{ Form::label('post_body', trans('admin.post_body'), ['class' => 'control-label']) }}
        <div class='controls'>
            {{ Form::textarea('post_body', null, ['placeholder' => trans('admin.post_body_text')]) }}
        </div>
    </div>

    <div id = "options_group" class='control-group'>
        {{ Form::label('options', trans('admin.options'),['class' => 'control-label']) }}
        <div class='controls'>
            {{ Form::text('options', null, ['placeholder' => trans('admin.options')]) }}
        </div>
    </div>

    <div class='control-group'>
        {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) }}
        <a class = 'btn', href="{{URL::route('admin.check', array('lang' =>App::getLocale()))}}/{{ $check->user_id}}">{{ trans('admin.cancel') }}</a>
    </div>
        {{ Form::hidden('user_id', null) }}
        {{ Form::hidden('check_id', null) }}
    {{ Form::close() }}

</div>

@stop