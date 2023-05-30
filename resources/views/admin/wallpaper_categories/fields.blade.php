<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of wallpaper category']) !!}
</div>

<!-- Musicians Field -->
<div class="form-group col-sm-12">
    {!! Form::label('musicians', 'Musicians:') !!}
    {!! Form::select('musicians[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any music band for the musician ?', 'multiple' => 'multiple', 'id' => 'musicians']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-12">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => 'Order in which it should appear']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.wallpaperCategories.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    @include('admin.select2_templates.musicians')
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
    </script>
@endpush
