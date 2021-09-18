@extends('adminlte::page')

@section('title', 'Scam Centers | Lara Admin')

@section('content_header')
@include('flash-message')
<div class="row mb-2">
<div class="col-sm-6">
<h1>Scam Centers List</h1>
</div>
<div class="col-sm-6"><a class="breadcrumb float-sm-right" href="{{URL::to('/')}}/scamcenters/create" >Add Scam Center</a></div>
</div>
@stop

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th width="30px">ID</th>
                <th>Comapny Name</th>
                <th>Scam Type</th>
                <th>Contact Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>IP Address</th>
               {{--<th>Address</th>
                <th>Country</th>--}}
                <th width="100px">Action</th>
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
                    $(".center-del-btn").click(function () {
                        let r = confirm('Are you sure you want to delete this item?');
                        return (r === true);
                    })
                },
        serverSide: true,
        ajax: "{{ route('scamcenters.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company_name', name: 'company_name'},
            {data: 'scam_type_id', name: 'scam_type_id'},
            {data: 'contact_name', name: 'contact_name'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'email', name: 'email'},
            {data: 'ip_address', name: 'ip_address'},
                {{--{data: 'address', name: 'address'},
            {data: 'country_id', name: 'country_id'},--}}
  {data: 'action', name: 'action'},
        ],
		columnDefs: [
            {
                orderable: false,
                targets: [7]
            },
            {
                searchable: false,
                targets: [7]
            }
		],
    });
  });
 </script>


