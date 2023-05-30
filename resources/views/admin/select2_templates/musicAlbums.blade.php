<script id="MusicAlbumOptionsTemplate" type="text/template">
    <div style="display: flex;">
        <div class="musicAlbum-img pr-1">
            <img src="%%AVATAR-URL%%" alt="Music Album Image"
                 class="img-size-50">
        </div>
        <div class="musicAlbum-name" style="display: grid; text-transform: capitalize">
            <strong>%%NAME%%</strong>
        </div>
    </div>
</script>

<script>
    function formatMusicAlbumOptions(musicAlbum) {
        if (musicAlbum.loading) {
            return musicAlbum.name;
        }
        let html = '';
        html = $('#MusicAlbumOptionsTemplate').html()
            .replace(/%%NAME%%/g, '' + musicAlbum.name)
            .replace(/%%AVATAR-URL%%/g, '' + musicAlbum.avatar)
        return $(html);
    }

    function formatMusicAlbumSelection(musicAlbum) {
        if (musicAlbum.id === '') { // adjust for custom placeholder values
            return 'Select/Search Music Album';
        }
        return musicAlbum.name;
    }
</script>
