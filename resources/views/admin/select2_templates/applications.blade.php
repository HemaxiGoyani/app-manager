<script id="applicationOptionsTemplate" type="text/template">
    <div style="display: flex;">
        <div class="application-name" style="display: grid; text-transform: capitalize">
            <strong>%%NAME%%</strong>
            <small class="application-version">
                Version: %%VERSION%% | Account: %%ACCOUNT%%
            </small>
        </div>
    </div>
</script>

<script>
    function formatApplicationOptions(application) {
        if (application.loading) {
            return application.name;
        }
        let html = '';
        html = $('#applicationOptionsTemplate').html()
            .replace(/%%NAME%%/g, '' + application.name)
            .replace(/%%VERSION%%/g, '' + application.version)
            .replace(/%%ACCOUNT%%/g, '' + application.account);
        return $(html);
    }

    function formatApplicationSelection(application) {
        if (application.id === '') { // adjust for custom placeholder values
            return 'Select/Search Application';
        }
        return application.name;
    }
</script>
