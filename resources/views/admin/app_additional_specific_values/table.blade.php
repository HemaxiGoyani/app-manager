@section('css')
    @include('admin.layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered', 'id' => 'appAdditionalSpecificValue-index']) !!}

@push('stackedScripts')
    @include('admin.layouts.datatables_js')
    <script>
        function additional_dt_data(){
            return {
                'from_date': $('#from-date').val(),
                'to_date': $('#to-date').val(),
                'applications': $('#applications').val(),
                'attributes': $('#attributes').val(),
            };
        }
    </script>
    {!! $dataTable->scripts() !!}
@endpush
