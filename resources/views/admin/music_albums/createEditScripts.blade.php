<script>
    @php
        $oldApplications = old('applications') ? \App\Models\Application::whereIn('uuid', old('applications'))->get() : null;
        $applicationObjects = $oldApplications ?? (isset($musicAlbum) ? $musicAlbum->applications : null);
        $applications = $applicationObjects ? $applicationObjects->map(function(\App\Models\Application $application){
            return \App\Http\Controllers\Admin\ApplicationSearchController::getResultsArr_forGeneralUse($application);
        }) : [];

      $oldMusicBands = old('music_bands') ? \App\Models\MusicBand::whereIn('uuid', old('music_bands'))->get() : null;
        $musicBandObjects = $oldMusicBands ?? (isset($musicAlbum) ? $musicAlbum->musicBands : null);
        $musicBands = $musicBandObjects ? $musicBandObjects->map(function(\App\Models\MusicBand $musicBand){
            return \App\Http\Controllers\Admin\MusicBandSearchController::getResultsArr_forGeneralUse($musicBand);
        }) : [];
    @endphp
    fillSelect2($('#applications'), @json($applications))
    fillSelect2($('#music_bands'), @json($musicBands))
</script>
