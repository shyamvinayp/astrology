<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@include('partials.form.validation.scripts')
<script>
    $(function() {
        let form = $('#telecom-main-form');
        form.parsley();

    });
</script>
