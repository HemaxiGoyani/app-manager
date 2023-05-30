<script id="MusicBandOptionsTemplate" type="text/template">
    <div style="display: flex;">
        <div class="user-img pr-1">
            <img src="%%AVATAR-URL%%" alt="Music Band Image"
                 class="img-size-50">
        </div>
        <div class="musicBand-name" style="display: grid; text-transform: capitalize">
            <strong>%%NAME%%</strong>
        </div>
    </div>
</script>

<script>
    function formatMusicBandOptions(musicBand) {
        if (musicBand.loading) {
            return musicBand.name;
        }
        let html = '';
        html = $('#MusicBandOptionsTemplate').html()
            .replace(/%%NAME%%/g, '' + musicBand.name)
            .replace(/%%AVATAR-URL%%/g, '' + musicBand.avatar)
        return $(html);
    }

    function formatMusicBandSelection(musicBand) {
        if (musicBand.id === '') { // adjust for custom placeholder values
            return 'Select/Search Music Band';
        }
        return musicBand.name;
    }
</script>
