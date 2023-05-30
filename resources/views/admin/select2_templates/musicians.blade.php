<script id="MusicianOptionsTemplate" type="text/template">
    <div style="display: flex;">
        <div class="musician-name" style="display: grid; text-transform: capitalize">
            <strong>%%NAME%%</strong>
            <small class="application-version">
                Music Band: %%BAND%%
            </small>
        </div>
    </div>
</script>

<script>
    function formatMusicianOptions(musician) {
        if (musician.loading) {
            return musician.name;
        }
        let html = '';
        html = $('#MusicianOptionsTemplate').html()
            .replace(/%%NAME%%/g, '' + musician.name)
            .replace(/%%BAND%%/g, '' + musician.band)
        return $(html);
    }

    function formatMusicianSelection(musician) {
        if (musician.id === '') { // adjust for custom placeholder values
            return 'Select/Search Musician';
        }
        return musician.name;
    }
</script>
