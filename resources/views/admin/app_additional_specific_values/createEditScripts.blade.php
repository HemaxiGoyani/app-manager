<script>
    $('#app_fk').val("{{ old('app_fk') ?? $appAdditionalSpecificValue->application->uuid ?? '' }}").trigger('change');
    $('#attribute_fk').val("{{ old('attribute_fk') ?? $appAdditionalSpecificValue->attribute->uuid ?? '' }}").trigger('change');
</script>
