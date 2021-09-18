@extends('adminlte::page')

@section('title', 'Agents | Lara Admin')

@section('content_header')
@include('flash-message')


@stop

@section('content')
    @include("cdrs.partials.search-form-fields")
    {{--@include("cdrs.search")--}}


    <div class="row mb-3 pb-3 border-top">
        <div class="col-sm-6">
            <h1>CDR List</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{URL::to('/')}}/cdrs/exportCdrData" class="btn btn-info float-sm-right mr-2 mt-2" role="button">Export CDR</a>
        </div>
    </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th width="20px">ID</th>
                <th>Start Date</th>
                <th>Camp Name</th>
                <th>Agent Name</th>
                <th>Agent ID</th>
                <th>Caller ID</th>
                <th>Scam Phone</th>
                <th>Duration (Sec)</th>
                <th>SIP Cause</th>
                <th>Hangup Reason</th>

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
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    var table = $('.data-table').DataTable({
		 buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        processing: true,
		drawCallback: function () {
                    $(".user-del-btn").click(function () {
                        let r = confirm('Are you sure you want to delete this item?');
                        return (r === true);
                    })
                },
        serverSide: true,

        ajax: {
            url: "{{ url('cdrs/search') }}",
            type: 'GET',
            data: function (d) {
                d.start_stamp = $('#start_stamp').val();
                d.end_stamp = $('#end_stamp').val();
            }
        },
        columns: [
            {data: 'id', name: 'id'},
           {data: 'start_stamp', name: 'start_stamp'},
            {data: 'camp_name', name: 'camp_name'},
            {data: 'agent_name', name: 'agent_name'},
            {data: 'agent_id', name: 'agent_id'},
            {data: 'callerid', name: 'callerid'},
            {data: 'destination_number', name: 'destination_number'},
            {data: 'duration', name: 'duration'},
            {data: 'sip_cause_code', name: 'sip_cause_code'},
            {data: 'sip_hangup_disposition', name: 'sip_hangup_disposition'},

        ],
    });

      $('#btnFiterSubmitSearch').click(function(){
          $('.data-table').DataTable().draw(true);
      });

  });


</script>


