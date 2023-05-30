<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $account->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $account->name }}</p>
</div>

<!-- Privacy Policy Url Field -->
<div class="form-group">
    {!! Form::label('privacy_policy_url', 'Privacy Policy Url:') !!}
    <p>{{ $account->privacy_policy_url }}</p>
</div>

<!-- Play Console Url Field -->
<div class="form-group">
    {!! Form::label('play_console_url', 'Play Console Url:') !!}
    <p>{{ $account->play_console_url }}</p>
</div>

<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{{ $account->uuid }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $account->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $account->updated_at }}</p>
</div>

