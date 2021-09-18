<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@include('partials.form.validation.scripts')
<script>
    $(function() {
        let form = $('#telecom-main-form');
        form.parsley();


        $(".ip-address-copy").hide();
        $(".ip-address-add-more").click(function(){
            var html = $(".ip-address-copy").html();
            $(".ip-address-after-add-more").after(html);
        });
        $("body").on("click",".ip-address-remove",function(){
            $(this).parents(".control-group").remove();
        });

        // email field add more and remove script
       $(".email-copy").hide();
        $(".email-add-more").click(function(){
            var html = $(".email-copy").html();
            console.log(html);
            $(".email-after-add-more").after(html);
        });
        $("body").on("click",".email-remove",function(){
            $(this).parents(".control-group").remove();
        });

        // media IPS field add more and remove script
        $(".media-copy").hide();
        $(".media-add-more").click(function(){
            var html = $(".media-copy").html();
            console.log(html);
            $(".media-after-add-more").after(html);
        });
        $("body").on("click",".media-remove",function(){
            $(this).parents(".control-group").remove();
        });


    });
</script>
