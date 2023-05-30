<!-- App Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('app_fk', 'Application:') !!}
    {!! Form::select('app_fk', $applicationItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder'=>'Select application']) !!}
</div>

<!-- Attribute Fk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attribute_fk', 'Attribute:') !!}
    {!! Form::select('attribute_fk', $additional_specific_attributeItems, null, ['class' => 'form-control select2_with_placeholder', 'data-placeholder'=>'Select attribute']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::text('value', null, ['class' => 'form-control', 'placeholder'=>'Value of additional specific attribute']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.appAdditionalSpecificValues.index') }}" class="btn btn-default">Cancel</a>
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
