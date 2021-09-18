@extends('adminlte::page')

@section('content_header')
@include('flash-message')
<h1>Users List</h1>
@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th width="100px">ID</th>
                <th>Name</th>
                <th>Email</th>
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
</style>
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
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
			{
                        mRender: function (data, type, row) {
                            return '<div class="text-center" style="width:100%; min-width:80px"> ' +
                                    '<a href="/sipnected_new/users/' + row.id + '/edit"   class="btn btn-xs btn-info" style="padding: 8px 13px;"><i class="fa fa-edit"></i></a>'+
                                '<form method="POST" action="/sipnected_new/users/'+row.id+'" accept-charset="UTF-8" style="display:inline;"><input name="_method" value="DELETE" type="hidden"><input name="_token" value="{{ csrf_token() }}" type="hidden"> <button class="btn btn-xs btn-danger user-del-btn" style="padding: 8px 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button></form></div>';
                        }
                    }
        ],
		columnDefs: [
			{
				orderable: false,
				targets: [3]
			},
			{
				searchable: false,
				targets: [3]
			}
		],
    });
  });
 </script>


