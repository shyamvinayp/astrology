@extends('adminlte::page')

@section('title', 'Carriers | Lara Admin')

@section('content_header')
@include('flash-message')
<div class="row mb-2">
<div class="col-sm-6">
<h1>Carriers List</h1>
</div>

    @if(Auth::user())
        @if(Auth::user()->type === 1)
            <div class="col-sm-6"><a class="breadcrumb float-sm-right" href="{{URL::to('/')}}/carriers/create" >Add Carrier</a></div>
        @endif
    @endif
</div>
@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th width="50px">ID</th>
                <th width="150px">Comapny Name</th>
                <th width="150px">Address</th>
                <th>Country</th>
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
                    $(".carrier-del-btn").click(function () {
                        let r = confirm('Are you sure you want to delete this item?');
                        return (r === true);
                    })
                },
        serverSide: true,
        ajax: "{{ route('carriers.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company_name', name: 'company_name'},
            {data: 'address', name: 'address'},
            {data: 'country_id', name: 'country_id'},
            {data: 'action', name: 'action'},
        ],
		columnDefs: [
			{
				orderable: false,
				targets: [4]
			},
			{
				searchable: false,
				targets: [4]
			}
		],
    });
  });
 </script>


