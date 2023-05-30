<script>
    $('#account_fk').val("{{ old('account_fk') ?? $application->account->uuid ?? '' }}").trigger('change');
</script>
