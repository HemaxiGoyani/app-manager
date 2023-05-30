<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('from_date', 'From date:') !!}
        {!! Form::text('from_date', null, ['class' => 'form-control datepicker filter', 'autocomplete' => 'off','id'=>'from-date', 'placeholder' => 'From date to filter?']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('to_date', 'To date:') !!}
        {!! Form::text('to_date', null, ['class' => 'form-control datepicker filter', 'autocomplete' => 'off','id'=>'to-date', 'placeholder' => 'To date to filter?']) !!}
    </div>

    <!-- Applications Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('applications', 'Applications:') !!}
        @include('admin.layouts.templates.filter-type-generator',[
            'filterName' => 'applications',
            'input' => Form::select('applications[]', $applicationItems, [], ['class' => 'form-control select2-multiple filter','style'=>'width:99.9%', 'data-placeholder' => 'Any applications?', 'multiple' => 'multiple', 'id' => 'applications'])
        ])
    </div>


    <!-- Applications Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('attributes', 'Attributes:') !!}
        @include('admin.layouts.templates.filter-type-generator',[
            'filterName' => 'attributes',
            'input' => Form::select('attributes[]', $additional_specific_attributeItems, [], ['class' => 'form-control select2-multiple filter','style'=>'width:99.9%', 'data-placeholder' => 'Any attributes?', 'multiple' => 'multiple', 'id' => 'attributes'])
        ])
    </div>

</div>
@push('stackedScripts')
    <script>

        function setDefaults(){
            $("#from-date").setCustomDate(new Date(moment().startOf('month').format()));
            removeStoredFilters();
            $('.buttons-reload').click();
        }

    </script>
@endpush
