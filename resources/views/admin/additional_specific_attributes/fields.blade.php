<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of attribute']) !!}
</div>

<!-- Data Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_type', 'Data Type:') !!}
    {!! Form::text('data_type', null, ['class' => 'form-control', 'placeholder'=>'Data type of attribute']) !!}
</div>

<!-- Parent Attribute Field -->
<div class="form-group col-sm-12">
    {!! Form::label('parent_attribute', 'Parent Attribute:') !!}  @if(isset($additionalSpecificAttribute) && $additionalSpecificAttribute->parent)(<a href="{{ route('admin.additionalSpecificAttributes.show', $additionalSpecificAttribute->parent) }}" target="_blank">Open Parent Attribute</a>)@endif
    {!! Form::select('parent_attribute', [], null, ['class' => 'form-control', ]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.additionalSpecificAttributes.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    @include('admin.select2_templates.attributes')
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

        //Initializes Ajax based select2 on tasks.
        initAjaxSelect2($('#parent_attribute'), function (params) {
                return "{{ route('admin.attributes.search') }}" + "?term="+ (params.term ?? '') + getAttributeSearchExceptString();
            }, function (params) {
                return {pageNo: params.page || 1, noOfRecords: 10};
            }, 'Any parent attribute to it?', formatAttributeOptions, formatAttributeSelection, 'GET'
        );

        function getAttributeSearchExceptString(){
            @if(isset($additionalSpecificAttribute))
                return '&except={{ $additionalSpecificAttribute->uuid }}';
            @else
                return '';
            @endif
        }
    </script>
@endpush
