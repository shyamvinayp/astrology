<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@include('partials.form.validation.scripts')
<script>
    $(function() {
        let form = $('#telecom-main-form');
        form.parsley();

        $("#bulk").hide();

        $('#bulk-action').on('change', function(){
            let selectedValue = $('#bulk-action').val();
            if(selectedValue === 'bulk'){
                $("#bulk").show();
                $('#bulk-extension').prop('required', true);

            } else {
                $("#bulk").hide();
                $('#bulk-extension').prop('required', false);
            }
        });

    });
</script>
