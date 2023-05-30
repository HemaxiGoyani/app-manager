<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of musician']) !!}
</div>

<!-- Assignees Field -->
<div class="form-group col-sm-12">
    {!! Form::label('applications', 'Applications:') !!}
    {!! Form::select('applications[]', [], [], ['class' => 'form-control hasAjaxSelect2', 'style'=>'width:99.9%', 'data-placeholder' => 'Any application for the musicians?', 'multiple' => 'multiple', 'id' => 'applications']) !!}
</div>

<!-- Band Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('band_fk', 'Music Band:') !!}
    {!! Form::select('band_fk', $music_bandItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder'=>'Select Music Band']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => 'Order in which it should appear']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.musicians.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    @include('admin.select2_templates.applications')
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
    </script>
@endpush
