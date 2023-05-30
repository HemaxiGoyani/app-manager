<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $musicLyric->id }}</p>
</div>

<!-- Music Fk Field -->
<div class="form-group">
    {!! Form::label('music_fk', 'Music Fk:') !!}
    <p>{{ $musicLyric->music_fk }}</p>
</div>

<!-- Language Fk Field -->
<div class="form-group">
    {!! Form::label('language_fk', 'Language Fk:') !!}
    <p>{{ $musicLyric->language_fk }}</p>
</div>

<!-- Lyrics Field -->
<div class="form-group">
    {!! Form::label('lyrics', 'Lyrics:') !!}
    <p>{{ $musicLyric->lyrics }}</p>
</div>

<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{{ $musicLyric->uuid }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $musicLyric->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $musicLyric->updated_at }}</p>
</div>

