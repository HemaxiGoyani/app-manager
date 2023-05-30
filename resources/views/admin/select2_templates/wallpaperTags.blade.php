<script id="WallpaperTagOptionsTemplate" type="text/template">
    <div style="display: flex;">
        <div class="wallpaperTag-name" style="display: grid; text-transform: capitalize">
            <strong>%%NAME%%</strong>
            <small class="application-version">
                Last updated at %%DATE%%
            </small>
        </div>
    </div>
</script>

<script>
    function formatWallpaperTagOptions(wallpaperTag) {
        if (wallpaperTag.loading) {
            return wallpaperTag.name;
        }
        let html = '';
        html = $('#WallpaperTagOptionsTemplate').html()
            .replace(/%%NAME%%/g, '' + wallpaperTag.name)
            .replace(/%%DATE%%/g, '' + wallpaperTag.updated_at)
        return $(html);
    }

    function formatWallpaperTagSelection(wallpaperTag) {
        if (wallpaperTag.id === '') { // adjust for custom placeholder values
            return 'Select/Search wallpaper Tag';
        }
        return wallpaperTag.name;
    }
</script>
