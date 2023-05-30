<script>
    @php
        $oldApplications = old('applications') ? \App\Models\Application::whereIn('uuid', old('applications'))->get() : null;
        $applicationObjects = $oldApplications ?? (isset($musicBand) ? $musicBand->applications : null);
        $applications = $applicationObjects ? $applicationObjects->map(function(\App\Models\Application $application){
            return \App\Http\Controllers\Admin\ApplicationSearchController::getResultsArr_forGeneralUse($application);
        }) : [];
    @endphp
    fillSelect2($('#applications'), @json($applications))
</script>
