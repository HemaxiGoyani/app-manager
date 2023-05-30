<script>
    $('#musician_fk').val("{{ old('musician_fk') ?? $musicianVideo->musician->uuid ?? '' }}").trigger('change');
</script>
