<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

        form.on('submit', function() {
            return form.jqxValidator('validate');
        });

        let pageHeaderNav = $('.nav');

        $('.tab-pane').hide();
        pageHeaderNav.find('.page-header-tab:first').addClass('active');
        $('.nav a').click(function() {
            //alert('here i am');
            $('.tab-pane').hide();
            var index = $(this).parent().index();
            $('.tab-pane').eq(index).show();
        })
        $('.tab-pane:first').show();


    });
</script>
