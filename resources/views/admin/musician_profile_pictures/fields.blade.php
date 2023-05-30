<div class="col-sm-9">
    <!-- Name Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of musician profile picture']) !!}
        <span class="text-danger" style="font-size:14px"><i>Optional</i></span>
    </div>

    <!-- Musician Fk Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('musician_fk', 'Musician:') !!}
        {!! Form::select('musician_fk', $musicianItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder' => 'Select musician']) !!}
    </div>


    <!-- Order Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('order', 'Order:') !!}
        {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => 'Order in which it should appear']) !!}
    </div>
</div>

<div class="sImageOuterContainer col-sm-3">
    <div id="sImageContainer_id" class='sImageContainer mayContainError fastAnimation' tabindex='1'>
        <div class='sImagePlaceholderDiv {{ isset($musicianProfilePicture) ? 'd-none' : '' }}'>
            <div class='sImagePlaceholderText text-center'>
                Select User Avatar<br/>(Max: 1 MB)
            </div>
        </div>
        <div class='sImagePreview {{ isset($musicianProfilePicture) ? '' : 'd-none' }}'>
            <img id='sImagePreview_id' class='sImagePreviewImg' alt='Avatar'
                 src='{{ isset($musicianProfilePicture) ? $musicianProfilePicture->avatar_url['250'] : route('images_default',['resolution' => '250x250']) }}'
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
    <a href="{{ route('admin.musicianProfilePictures.index') }}" class="btn btn-default">Cancel</a>
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
