<script>
    @php
        $oldMusicians = old('musicians') ? \App\Models\Musician::whereIn('uuid', old('musicians'))->get() : null;
        $musicianObjects = $oldMusicians ?? (isset($wallpaper) ? $wallpaper->musicians : null);
        $musicians = $musicianObjects ? $musicianObjects->map(function(\App\Models\Musician $musician){
            return \App\Http\Controllers\Admin\MusicianSearchController::getResultsArr_forGeneralUse($musician);
        }) : [];

        $oldWallpaperTags = old('wallpaper_tags') ? \App\Models\WallpaperTag::whereIn('uuid', old('wallpaper_tags'))->get() : null;
        $wallpaperTagObjects = $oldWallpaperTags ?? (isset($wallpaper) ? $wallpaper->tags : null);
        $wallpaperTags = $wallpaperTagObjects ? $wallpaperTagObjects->map(function(\App\Models\WallpaperTag $wallpaperTag){
            return \App\Http\Controllers\Admin\WallpaperTagSearchController::getResultsArr_forGeneralUse($wallpaperTag);
        }) : [];

    @endphp
    fillSelect2($('#musicians'), @json($wallpaperTags))
    fillSelect2($('#wallpaper_tags'), @json($wallpaperTags))

    $('#category_fk').val("{{ old('category_fk') ?? $wallpaper->category->uuid ?? '' }}").trigger('change');
</script>
