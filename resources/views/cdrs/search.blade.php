
<div class="row mb-2  pb-3">
    <div class="col-sm-6">
        <h1>CDR List</h1>
    </div>
    <div class="col-sm-6">
        <a class="btn btn-info float-sm-right" href="{{URL::to('/')}}/callerids/create" >Create Caller ID</a> &nbsp;
        <a href="{{URL::to('/')}}/callerids/import" class="btn btn-info float-sm-right mr-2" role="button">Import Caller ID</a>
        <a href="{{URL::to('/')}}/callerids/exportCalleridData" class="btn btn-info float-sm-right mr-2" role="button">Export Caller ID</a>
    </div>
</div>
<table class="table table-bordered data-table">
    <thead>
    <tr>
        <th width="100px">ID</th>
        <th>Caller ID</th>
        <th>Caller Group</th>
        <th width="200px">Action</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop

<meta name="csrf-token" content="{{ csrf_token() }}">
<!--<link href="{{ asset('css/datatables/bootstrap.min.css')}}" rel="stylesheet">-->

<link href="{{ asset('css/datatables/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>
<script src="{!! asset('js/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('js/datatables/dataTables.bootstrap4.min.js') !!}"></script>

<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            drawCallback: function () {
                $(".user-del-btn").click(function () {
                    let r = confirm('Are you sure you want to delete this item?');
                    return (r === true);
                })
            },
            serverSide: true,
            ajax: "{{ route('cdrs.search') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'callerid', name: 'callerid'},
                {data: 'destination_number', name: 'destination_number'},
                {data: 'end_stamp', name: 'end_stamp'},
            ],
        });
    });
</script>
