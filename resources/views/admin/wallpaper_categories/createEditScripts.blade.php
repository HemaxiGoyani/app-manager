<script>
    @php
        $oldmusicians = old('musicians') ? \App\Models\Musician::whereIn('uuid', old('musicians'))->get() : null;
        $musicianObjects = $oldmusicians ?? (isset($wallpaperCategory) ? $wallpaperCategory->musicians : null);
        $musicians = $musicianObjects ? $musicianObjects->map(function(\App\Models\Musician $musician){
            return \App\Http\Controllers\Admin\MusicianSearchController::getResultsArr_forGeneralUse($musician);
        }) : [];

    @endphp
    fillSelect2($('#musicians'), @json($musicians))
</script>
