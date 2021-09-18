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

        let pageHeaderNav = $('.nav');
        let navSidebar = $('.mt-2');


        $(".sidebar li .nav-link a").click(function() {
            alert('hello testing');
            //$(this).parent().addghfghfghfghgjClass('active');

        });

        var url = window.location;


        // for sidebar menu entirely but not cover treeview
        //$('ul.nav-sidebar').find('li.nav-item a').click(function() {
            //alert('hello testing');
            //return this.href == url;
        //}).parent().addClass('active');


        /*navSidebar.find('.nav-link').addClass('active');

        navSidebar.find('.nav-link a').click(function(){
            alert('hello');
        })*/

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



        let credentials = $('#credentials');
        let ipAddress  = $('#ip_address');
        let uri        = $('#uri');
        let forward        = $('#forward');
        // div content id
        let credentialsContent = $('#credentials-content');
        let ipAddressContent  = $('#ip_address-content');
        let uriContent        = $('#uri-content');
        let forwardContent    = $('#forward-content');

        let venueTypeInputs = $('input[name=tbl_connection_type]');

        venueTypeInputs.on('change', function () {
            radioBoxLisener();
            //toggleVirtualDataFields();
        });

        // Work when fixed radio button checked
        function radioBoxLisener() {
            let selected = $('input[name=tbl_connection_type]:checked');
            if(selected.val() === '1') { // credentials
                credentialsContent.show();
                ipAddressContent.hide();
                uriContent.hide();
                forwardContent.hide();

            } else if(selected.val() === '2'){ //ip_address
                ipAddressContent.show();
                credentialsContent.hide();
                uriContent.hide();
                forwardContent.hide();

            } else if(selected.val() === '3'){ //uri
                uriContent.show();
                credentialsContent.hide();
                ipAddressContent.hide();
                forwardContent.hide();
            } else if(selected.val() === '4') { //forward
                forwardContent.show();
                credentialsContent.hide();
                ipAddressContent.hide();
                uriContent.hide();
            }
        }

        credentialsContent.hide();
        ipAddressContent.hide();
        uriContent.hide();
        forwardContent.hide();

        radioBoxLisener();

        $(".copy").hide();
        $(".add-more").click(function(){
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });
        $("body").on("click",".remove",function(){
            $(this).parents(".control-group").remove();
        });


        let connectionName = $('input[name=tbl_sip_connection_name]');
        let createConnectionID = $('#createSIPConnection');
        //$('#edit-connection').hide();
        //connectionName.blur(function () {
        createConnectionID.click(function () {
            //alert(connectionName.val());
            let connectionValue = connectionName.val();

            $.ajax({
                type: "POST",
                url: "{!! route('connections.save-connection') !!}",
                data: {
                    name: connectionValue,
                },
                success: function (data) {
                    if (data.status === 'success') {
                        //console.log(data);
                        if (data.connectionStatus == 'exists') {
                            $('.text-danger').text(data.message);
                        } else if (data.connectionStatus == 'new') {
                            $('#add-connection').hide();
                            $('.modal-title').text('Edit SIP Connection');
                            $('#edit-connection').append(data.html);
                            $('#edit-connection').show();

                        }
                    }
                }

            });


        });

    });


    function changeStatus(id){
        $.ajax({
            type: "POST",
            url: "{!! route('connections.update-status') !!}",
            data: {
                'id': id,
            },
            success: function (data) {
                if (data.status === 'success') {
                    console.log(data);
                    //$('.dataTables_wrapper').append('<div class="text-success">'+data.message+'</div>');
                     window.location.href = "connections";

                }
            }

        });
    }

</script>

