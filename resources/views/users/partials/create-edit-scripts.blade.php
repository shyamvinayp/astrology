<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@include('partials.form.validation.scripts')
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let form = $('#telecom-main-form');
        form.parsley();




    });
</script>
