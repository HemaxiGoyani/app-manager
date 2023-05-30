<div class="col-sm-9">
    <!-- Name Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of music album']) !!}
    </div>

    <!-- Applications Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('applications', 'Applications:') !!}
        {!! Form::select('applications[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any application for the music album?', 'multiple' => 'multiple', 'id' => 'applications']) !!}
    </div>

    <!-- Music Bands Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('music_bands', 'Music Bands:') !!}
        {!! Form::select('music_bands[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any music band for the music album?', 'multiple' => 'multiple', 'id' => 'music_bands']) !!}
    </div>

    <!-- Order Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('order', 'Order:') !!}
        {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => 'Order in which it should appear']) !!}
    </div>
</div>

<div class="sImageOuterContainer col-sm-3">
    <div id="sImageContainer_id" class='sImageContainer mayContainError fastAnimation' tabindex='1'>
        <div class='sImagePlaceholderDiv {{ isset($musicAlbum) ? 'd-none' : '' }}'>
            <div class='sImagePlaceholderText text-center'>
                Select User Avatar<br/>(Max: 1 MB)
            </div>
        </div>
        <div class='sImagePreview {{ isset($musicAlbum) ? '' : 'd-none' }}'>
            <img id='sImagePreview_id' class='sImagePreviewImg' alt='Avatar'
                 src='{{ isset($musicAlbum) ? $musicAlbum->avatar_url['250'] : route('images_default',['resolution' => '250x250']) }}'
            />
            <div class='sImage_Overlay'>
                <a href='#' class='icon removeSImageBtn' title='Avatar'>
                    <i class='fa fa-trash'></i>
                </a>
            </div>
        </div>
    </div>
    <input type="file" name="avatar" id="sImage_id"
           class="uploadFile img" value="Upload Photo"
           style="width: 0px;height: 0px;overflow: hidden;" max-size=1048576 data-sImageDeletedInputName="avatarDeleted"
           onchange=previewImg(this);
    >
    <input type="hidden" name="avatarDeleted" value="0">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.musicAlbums.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    @include('admin.select2_templates.applications')
    @include('admin.select2_templates.musicBands')
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

                console.log(params);
                return "{{ route('admin.applications.searchApplication') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, applicationsRef.data('placeholder'), formatApplicationOptions, formatApplicationSelection, 'GET', true
        )

        let musicBandsRef = $('#music_bands');

        initAjaxSelect2(musicBandsRef, function (params) {

                console.log(params);
                return "{{ route('admin.musicBands.searchMusicBand') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, musicBandsRef.data('placeholder'), formatMusicBandOptions, formatMusicBandSelection, 'GET', true
        )

    </script>
@endpush
