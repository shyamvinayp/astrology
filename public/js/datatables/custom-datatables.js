$(function() {

    /**
     * Datatables global settings
     */
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: window.baseUrl + '/js/datatables/languages/' + window.locale + '.json'
        },
        stateSave: true,
        processing: true,
        /*serverSide: true,*/
        initComplete: function () {
            $('select[name=crud-table_length]').select2({
                minimumResultsForSearch: -1,
                width: "60px"
            });
        }
    });
});