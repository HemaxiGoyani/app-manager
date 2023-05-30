<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $application->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $application->name }}</p>
</div>

<!-- Version Count Field -->
<div class="form-group">
    {!! Form::label('version_count', 'Version Count:') !!}
    <p>{{ $application->version_count }}</p>
</div>

<!-- Version Field -->
<div class="form-group">
    {!! Form::label('version', 'Version:') !!}
    <p>{{ $application->version }}</p>
</div>

<!-- Account Fk Field -->
<div class="form-group">
    {!! Form::label('account_fk', 'Account Fk:') !!}
    <p>{{ $application->account_fk }}</p>
</div>

<!-- Package Field -->
<div class="form-group">
    {!! Form::label('package', 'Package:') !!}
    <p>{{ $application->package }}</p>
</div>

<!-- Notification App Id Field -->
<div class="form-group">
    {!! Form::label('notification_app_id', 'Notification App Id:') !!}
    <p>{{ $application->notification_app_id }}</p>
</div>

<!-- Notification Server Key Field -->
<div class="form-group">
    {!! Form::label('notification_server_key', 'Notification Server Key:') !!}
    <p>{{ $application->notification_server_key }}</p>
</div>

<!-- Update Title Field -->
<div class="form-group">
    {!! Form::label('update_title', 'Update Title:') !!}
    <p>{{ $application->update_title }}</p>
</div>

<!-- Update Message Field -->
<div class="form-group">
    {!! Form::label('update_message', 'Update Message:') !!}
    <p>{{ $application->update_message }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $application->status }}</p>
</div>

<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{{ $application->uuid }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $application->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $application->updated_at }}</p>
</div>

