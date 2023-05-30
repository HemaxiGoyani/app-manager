<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of Application']) !!}
</div>

<!-- Version Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version_count', 'Version Count:') !!}
    {!! Form::number('version_count', null, ['class' => 'form-control', 'placeholder' => 'Version count']) !!}
</div>

<!-- Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version', 'Version:') !!}
    {!! Form::text('version', null, ['class' => 'form-control', 'placeholder' => 'Version of application']) !!}
</div>

<!-- Account Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account_fk', 'Account:') !!}
    {!! Form::select('account_fk', $accountItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder'=>'Select account']) !!}
</div>

<!-- Package Field -->
<div class="form-group col-sm-6">
    {!! Form::label('package', 'Package:') !!}
    {!! Form::text('package', null, ['class' => 'form-control', 'placeholder' => 'Package of application']) !!}
</div>

<!-- Notification App Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notification_app_id', 'Notification App Id:') !!}
    {!! Form::text('notification_app_id', null, ['class' => 'form-control', 'placeholder' => 'Application notification ID']) !!}
</div>

<!-- Notification Server Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notification_server_key', 'Notification Server Key:') !!}
    {!! Form::text('notification_server_key', null, ['class' => 'form-control', 'placeholder' =>'Notification server key']) !!}
</div>

<!-- Update Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_title', 'Update Title:') !!}
    {!! Form::text('update_title', null, ['class' => 'form-control', 'placeholder' => 'Update title of application']) !!}
</div>

<!-- Update Message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_message', 'Update Message:') !!}
    {!! Form::text('update_message', null, ['class' => 'form-control', 'placeholder' => 'Update message of application']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.applications.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '{{ $type ?? '' }}'
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate(){
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
