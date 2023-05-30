<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of Music record']) !!}
</div>

<!-- Applications Field -->
<div class="form-group col-sm-12">
    {!! Form::label('applications', 'Applications:') !!}
    {!! Form::select('applications[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any application for the music record?', 'multiple' => 'multiple', 'id' => 'applications']) !!}
</div>

<!-- Music Bands Field -->
<div class="form-group col-sm-12">
    {!! Form::label('music_bands', 'Music Bands:') !!}
    {!! Form::select('music_bands[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any music band for the music record?', 'multiple' => 'multiple', 'id' => 'music_bands']) !!}
</div>

<!-- Music Bands Field -->
<div class="form-group col-sm-12">
    {!! Form::label('music_albums', 'Music Album:') !!}
    {!! Form::select('music_albums[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any music band for the music album?', 'multiple' => 'multiple', 'id' => 'music_albums']) !!}
</div>

<!-- Music file At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('music', 'Music:') !!}
    {!! Form::file('music', ['class' => 'form-control', 'placeholder' => 'Add music here']) !!}
    @if(isset($musicRecord) && $musicRecord->hasMedia('musics'))
        <div class="brochureDiv pt-2">
            <audio controls><source src="{{$musicRecord->music_record_url['url']}}"  type='audio/mpeg'></audio>
        </div>
        <input type="hidden" name="musicDeleted" value="0">
    @else
        <i>Upload file here</i>
    @endif
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => 'Order in which it should appear']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.musicRecords.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    @include('admin.select2_templates.applications')
    @include('admin.select2_templates.musicBands')
    @include('admin.select2_templates.musicAlbums')
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

        let applicationsRef = $('#applications');

        initAjaxSelect2(applicationsRef, function (params) {
                return "{{ route('admin.applications.searchApplication') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, applicationsRef.data('placeholder'), formatApplicationOptions, formatApplicationSelection, 'GET', true
        )

        let musicBandsRef = $('#music_bands');

        initAjaxSelect2(musicBandsRef, function (params) {
                return "{{ route('admin.musicBands.searchMusicBand') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, musicBandsRef.data('placeholder'), formatMusicBandOptions, formatMusicBandSelection, 'GET', true
        )

        let musicRecordsRef = $('#music_albums');

        initAjaxSelect2(musicRecordsRef, function (params) {
                return "{{ route('admin.musicAlbums.searchMusicAlbum') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, musicRecordsRef.data('placeholder'), formatMusicAlbumOptions, formatMusicAlbumSelection, 'GET', true
        )

    </script>w
@endpush
