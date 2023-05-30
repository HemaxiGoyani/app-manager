<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $appAdditionalSpecificValue->id }}</p>
</div>

<!-- App Fk Field -->
<div class="form-group">
    {!! Form::label('app_fk', 'App Fk:') !!}
    <p>{{ $appAdditionalSpecificValue->app_fk }}</p>
</div>

<!-- Attribute Fk Field -->
<div class="form-group">
    {!! Form::label('attribute_fk', 'Attribute Fk:') !!}
    <p>{{ $appAdditionalSpecificValue->attribute_fk }}</p>
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $appAdditionalSpecificValue->value }}</p>
</div>

<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{{ $appAdditionalSpecificValue->uuid }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $appAdditionalSpecificValue->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $appAdditionalSpecificValue->updated_at }}</p>
</div>

