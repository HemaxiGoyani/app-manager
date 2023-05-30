@include('admin.layouts.templates.filter_modal', ['fieldBlade' => 'admin.app_additional_specific_values.filter_fields', 'reset' => true])
@push('stackedScripts')
    @include('admin.layouts.scripts.filter_helpers', ['filterScope' => 'app_additional_specific_values'])
    <script>
        let filterRef = $('.filter');
        filterRef.change(function () {
            $('.buttons-reload').click();
            updateFilterButton();
        });

        $(document).ready(function () {
            if(filterStorageExists())   setStoredFilters(); else    setDefaults();
            $('.buttons-reload').click();
            updateFilterButton();
        });

        $('.clear-filter-class').click(function () {
            emptyFilters();
            filterRef.each(function(){
                storeFilters($(this));
            });
            updateFilterButton();
            $('.buttons-reload').click();
        });
    </script>
@endpush
