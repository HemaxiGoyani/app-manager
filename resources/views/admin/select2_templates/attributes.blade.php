<script id="attributeOptionsTemplate" type="text/template">
    <div class="row">
        <div class="attribute-name col-sm-12">
            <strong>%%NAME%%</strong>
        </div>
    </div>
</script>

<script>
    function formatAttributeOptions(attribute) {
        if (attribute.loading) {
            return attribute.name;
        }
        html = $('#attributeOptionsTemplate').html()
            .replace(/%%NAME%%/g, '' + attribute.name)
        return $(html);
    }

    function formatAttributeSelection(attribute) {
        if (attribute.id === '') { // adjust for custom placeholder values
            return 'Select/Search Attribute';
        }
        return attribute.name;
    }
</script>
