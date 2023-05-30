<!-- Music Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('music_fk', 'Music:') !!}
    {!! Form::select('music_fk', $music_recordItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder'=>'Select Music Record']) !!}
</div>

<!-- Language Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_fk', 'Language:') !!}
    {!! Form::select('language_fk', $languageItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder'=>'Select language']) !!}
</div>

<!-- Lyrics Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('lyrics', 'Lyrics:') !!}
    {!! Form::textarea('lyrics', null, ['class' => 'form-control', 'rows' => 3, 'placeholder'=>'Lyrics of music']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.musicLyrics.index') }}" class="btn btn-default">Cancel</a>
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
