<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $additionalSpecificAttribute->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $additionalSpecificAttribute->name }}</p>
</div>

<!-- Data Type Field -->
<div class="form-group">
    {!! Form::label('data_type', 'Data Type:') !!}
    <p>{{ $additionalSpecificAttribute->data_type }}</p>
</div>

<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{{ $additionalSpecificAttribute->uuid }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $additionalSpecificAttribute->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $additionalSpecificAttribute->updated_at }}</p>
</div>

