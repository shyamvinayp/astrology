<script src="{!! asset('js/packages/parsley/parsley.min.js') !!}"></script>
<script>
    //custom global config
    window.ParsleyConfig = {
        errorsContainer: function (field) {
            let parent = field.$element.closest('.form-group');
            if(parent.length) {
                return parent;
            }
            return field;

        }
    };
</script>
