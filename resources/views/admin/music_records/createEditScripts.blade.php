<script>
    @php
        $oldApplications = old('applications') ? \App\Models\Application::whereIn('uuid', old('applications'))->get() : null;
        $applicationObjects = $oldApplications ?? (isset($musicRecord) ? $musicRecord->applications : null);
        $applications = $applicationObjects ? $applicationObjects->map(function(\App\Models\Application $application){
            return \App\Http\Controllers\Admin\ApplicationSearchController::getResultsArr_forGeneralUse($application);
        }) : [];

        $oldMusicBands = old('music_bands') ? \App\Models\MusicBand::whereIn('uuid', old('music_bands'))->get() : null;
        $musicBandObjects = $oldMusicBands ?? (isset($musicRecord) ? $musicRecord->musicBands : null);
        $musicBands = $musicBandObjects ? $musicBandObjects->map(function(\App\Models\MusicBand $musicBand){
            return \App\Http\Controllers\Admin\MusicBandSearchController::getResultsArr_forGeneralUse($musicBand);
        }) : [];

        $oldMusicAlbums = old('music_bands') ? \App\Models\MusicAlbum::whereIn('uuid', old('music_albums'))->get() : null;
        $musicAlbumObjects = $oldMusicAlbums ?? (isset($musicRecord) ? $musicRecord->musicAlbums : null);
        $musicAlbums = $musicAlbumObjects ? $musicAlbumObjects->map(function(\App\Models\MusicAlbum $musicAlbum){
            return \App\Http\Controllers\Admin\MusicAlbumSearchController::getResultsArr_forGeneralUse($musicAlbum);
        }) : [];

    @endphp
    fillSelect2($('#applications'), @json($applications))
    fillSelect2($('#music_bands'), @json($musicBands))
    fillSelect2($('#music_albums'), @json($musicAlbums))
</script>
