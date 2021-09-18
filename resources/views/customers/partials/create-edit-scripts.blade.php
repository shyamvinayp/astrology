<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@include('partials.form.validation.scripts')
<script>
    $(function() {

        $("ul.navbar-nav > a").on("click", function () {
            let url = $(this).attr("href");
            window.location = url;
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let form = $('#telecom-main-form');
        form.parsley();

        let pageHeaderNav = $('.nav');

       /*pageHeaderNav.find('.nav-link:last').removeClass('active');
        pageHeaderNav.find('.nav-link:first').addClass('active');
        pageHeaderNav.find('.nav-link').click(function(){
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
        })*/

        $('.tab-pane').hide();
        pageHeaderNav.find('.page-header-tab:first').addClass('active');
        $('.nav a').click(function() {
            $('.tab-pane').hide();
            var index = $(this).parent().index();
            $('.tab-pane').eq(index).show();
        })
        $('.tab-pane:first').show();


       /* $('.nav div').hide();
        $('#menu a').click(function(){
            $('.main div').hide();
            var tmp_div = $(this).parent().index();
            $('.main div').eq(tmp_div).show();
        });
        $('.main div').hide();
        */



    });
</script>
