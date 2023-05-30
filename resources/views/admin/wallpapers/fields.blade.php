<div class="col-sm-9">
    <!-- Name Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of wallpaper']) !!}
    </div>

    <!-- Category Fk Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('category_fk', 'Category:') !!}
        {!! Form::select('category_fk', $wallpaper_categoryItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder' => 'Select wallpaper category']) !!}
    </div>

    <!-- Musicians Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('musicians', 'Musicians:') !!}
        {!! Form::select('musicians[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any musician for the wallpaper ?', 'multiple' => 'multiple', 'id' => 'musicians']) !!}
    </div>

    <!-- Musicians Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('wallpaper_tags', 'Wallpaper Tags:') !!}
        {!! Form::select('wallpaper_tags[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any music band for the wallpaper tags ?', 'multiple' => 'multiple', 'id' => 'wallpaper_tags']) !!}
    </div>
</div>

<div class="sImageOuterContainer col-sm-3">
    <div id="sImageContainer_id" class='sImageContainer mayContainError fastAnimation' tabindex='1'>
        <div class='sImagePlaceholderDiv {{ isset($wallpaper) ? 'd-none' : '' }}'>
            <div class='sImagePlaceholderText text-center'>
                Select User Avatar<br/>(Max: 1 MB)
            </div>
        </div>
        <div class='sImagePreview {{ isset($wallpaper) ? '' : 'd-none' }}'>
            <img id='sImagePreview_id' class='sImagePreviewImg' alt='Avatar'
                 src='{{ isset($wallpaper) ? $wallpaper->avatar_url['250'] : route('images_default',['resolution' => '250x250']) }}'
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
    <a href="{{ route('admin.wallpapers.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    @include('admin.select2_templates.musicians')
    @include('admin.select2_templates.wallpaperTags')
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

        let musiciansRef = $('#musicians');

        initAjaxSelect2(musiciansRef, function (params) {

                console.log(params);
                return "{{ route('admin.musicians.searchMusician') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, musiciansRef.data('placeholder'), formatMusicianOptions, formatMusicianSelection, 'GET', true
        )

        let wallpaperTagsRef = $('#wallpaper_tags');

        initAjaxSelect2(wallpaperTagsRef, function (params) {

                console.log(params);
                return "{{ route('admin.wallpaperTags.searchWallpaperTag') }}" + "?term=" + (params.term ?? '');
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, wallpaperTagsRef.data('placeholder'), formatWallpaperTagOptions, formatWallpaperTagSelection, 'GET', true
        )

    </script>
@endpush
