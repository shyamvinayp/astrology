
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
    $(function() {
        alert("here i am");
        // When the demo modal is launched, load the values from localStorage
        $('#mdlDemo').on('show.bs.modal', function() {

            var user = JSON.parse(localStorage.getItem('SIPCreds'));

            if (user) {
                $.each(user, function(k, v) {
                    $('input[name="'+k+'"]').val(v);
                });
            }
        });

        // Save form to localStorage and validate
        $('#btnConfig').click(function(event) {
            alert("here in launch func")
            var user  = {},
                valid = true;

            event.preventDefault();

            // validate the form
            $('#mdlDemo input').each(function(i) {
                if ($(this).val() === '') {
                    $(this).closest('.form-group').addClass('has-error');
                    valid = false;
                } else {
                    $(this).closest('.form-group').removeClass('has-error');
                }
                user[$(this).attr('name')] = $(this).val();
            });

            // launch the phone window.
            if (valid) {
                localStorage.setItem('SIPCreds', JSON.stringify(user));

                var url      = 'https://' + window.location.host + window.location.pathname + 'phone/',
                    features = 'menubar=no,location=no,resizable=no,scrollbars=no,status=no,addressbar=no,width=320,height=480';

                if (!localStorage.getItem('ctxPhone')) {
                    window.open(url, 'ctxPhone', features);
                    $('#mdlDemo').modal('hide');
                    return false;
                } else {
                    window.alert('Phone already open.');
                }
            }

        });


    });
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-47777318-2', 'auto');
    ga('send', 'pageview');
</script>
