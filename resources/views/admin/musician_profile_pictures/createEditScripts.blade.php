<script>
    $('#musician_fk').val("{{ old('musician_fk') ?? $musicianProfilePicture->musician->uuid ?? '' }}").trigger('change');
</script>
