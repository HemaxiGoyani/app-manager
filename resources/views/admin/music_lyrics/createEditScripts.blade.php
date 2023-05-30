<script>
    $('#music_fk').val("{{ old('music_fk') ?? $musicLyric->music->uuid ?? '' }}").trigger('change');
    $('#language_fk').val("{{ old('language_fk') ?? $musicLyric->language->uuid ?? '' }}").trigger('change');
</script>
