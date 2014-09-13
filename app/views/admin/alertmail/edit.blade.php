@extends('layouts.admin')

@section('title')
{{ trans('admin.create_check') }}
@stop

@section('content')

<script language="javascript">
    function deleteButton(alert_id) {
        if(confirm(" {{ trans('admin.confirmdeleteemail') }} ") ){
            $('#deleteForm'+alert_id).submit();
        }
        else
            return false;
    }

    function editButton(alert_id){
        $('#editButton'+alert_id).addClass('hide');
        $('#deleteButton'+alert_id).addClass('hide');
        $('#saveButton'+alert_id).removeClass('hide');
        $('#cancelButton'+alert_id).removeClass('hide');
        $('#editInput'+alert_id).removeAttr('disabled');
    }

    function cancelButton(alert_id){
        $('#editButton'+alert_id).removeClass('hide');
        $('#deleteButton'+alert_id).removeClass('hide');
        $('#saveButton'+alert_id).addClass('hide');
        $('#cancelButton'+alert_id).addClass('hide');
        $('#editInput'+alert_id).attr('value', $('#storeInput'+alert_id).val());
        $('#editInput'+alert_id).attr('disabled','disabled');
    }
</script>

<div class="span10">

    <h1><i class='fa fa-envelope'></i> {{ trans('admin.edit_emails') }}</h1>

    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    @if(Session::has('error_message'))
        <p class="alert alert-danger">{{ Session::get('error_message') }}</p>
    @endif

    <ul style="list-style-type: none; margin-left: 0px; margin-top:30px;">
        @foreach($check->checkalertemail as $alert)
        <li>
            <div class="input-append">
                {{ Form::open(['role' => 'form', 'url' => URL::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check->check_id)).'/'.$alert->alert_id, 'method' => 'Put', 'class' => 'form-horizontal' ]) }}
                    {{ Form::hidden('check_id', $check->check_id) }}
                    {{ Form::hidden('alert_id', $alert->alert_id) }}
                    {{ Form::hidden('storeInput', $alert->alert_email, ['id'=> 'storeInput'.$alert->alert_id]) }}
                    {{ Form::email('email', $alert->alert_email, ['placeholder' => trans('admin.write_email'), 'id'=> 'editInput'.$alert->alert_id, 'disabled', 'class' => "span2",  'size' => '250' ]) }}
                    {{ HTML::decode(Form::button('<i class="icon-edit"></i>', array( 'id' => 'editButton'. $alert->alert_id,   'onclick' => 'javascript:editButton('. $alert->alert_id.')','type' => 'button', 'class' => 'btn btn-info'))) }}
                    {{ HTML::decode(Form::button('<i class="icon-check"></i>', array('id' => 'saveButton'.$alert->alert_id,'type' => 'submit', 'class' => 'btn btn-success  hide'))) }}
                    {{ HTML::decode(Form::button('<i class="icon-ban-circle"></i>', array('id' => 'cancelButton'.$alert->alert_id,  'onclick' => 'javascript:cancelButton('. $alert->alert_id.')', 'type' => 'button','class' => 'btn hide'))) }}
                    {{ HTML::decode(Form::button('<i class="icon-trash"></i>', array('id' => 'deleteButton'.$alert->alert_id, 'onclick' => 'javascript:deleteButton('. $alert->alert_id.')','type' => 'button','class' => 'btn btn-danger delete_form'))) }}
                {{ Form::close() }}
                {{ Form::open(['role' => 'form', 'url' => URL::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check->check_id)), 'method' => 'DELETE', 'class' => 'form-horizontal',  'id' => 'deleteForm'.$alert->alert_id ]) }}
                    {{ Form::hidden('check_id', $check->check_id) }}
                    {{ Form::hidden('alert_id', $alert->alert_id) }}
                {{ Form::close() }}
            </div>
        </li>

        @endforeach

        <li>
            <div class="input-append">
                {{ Form::open(['role' => 'form', 'url' => URL::route('admin.alert', array('lang' =>App::getLocale(), 'check_id' => $check->check_id)), 'class' => 'form-horizontal']) }}
                    {{ Form::hidden('check_id', $check->check_id) }}
                    {{ Form::email('email', '', ['placeholder' => trans('admin.write_email'), 'class' => "span2",  'size' => '250' ]) }}
                    {{ HTML::decode(Form::button('<i class="icon-envelope"></i> '.trans('admin.create'), array('type' => 'submit','class' => 'btn btn-success'))) }}
                {{ Form::close() }}
            </div>
        </li>
    </ul>

    <a href="{{URL::route('admin.check.user', array('lang' =>App::getLocale(), 'user_id' => $check->user->id))}}" class="btn pull-left">{{ trans('admin.return_ec') }}</a>

</div>

@stop