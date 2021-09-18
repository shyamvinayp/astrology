@extends('adminlte::page')
<style>
    .center {
        text-align:center;
        margin: auto;
        width: 50%;
        border: 3px solid #73AD21;
        padding: 10px;
    }
</style>
@section('title', 'Scam Phone | Lara Admin')

@section('content_header')
@include('flash-message')
<div class="row mb-2">
<div class="col-sm-6">
<h1>Scammer Phone List</h1>
</div>
    @if(Auth::user())
        @if(Auth::user()->type === 1)
            <div class="col-sm-6">
                <button class="btn btn-danger float-sm-right delete-all float-sm-right ml-2" role="button" data-url="">Delete All</button>
                <a href="{{URL::to('/')}}" class="btn btn-info float-sm-right" role="button">Report a scam call</a>
                <a data-toggle="modal" data-target="#modal-default" id="scam_import" href="#" class="btn btn-info float-sm-right mr-2" role="button">Import Scam Phone</a>
                <a href="{{URL::to('/')}}/scams/updateScamPhoneApiDetails" class="btn btn-info float-sm-right mr-2" role="button">Run API</a>
                {{--<a class="breadcrumb float-sm-right" data-toggle="modal" data-target="#modal-default" id="scam_import" href="#" >Import Scam Phone</a>
                <a class="breadcrumb float-sm-right" href="" >Report a scam call</a></div>--}}
        @endif
    @endif
</div>
@stop
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
        <div class="success-message"></div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="check_all"></th>
                <th>ID</th>
                <th>Phone Number</th>
                <th>Scam Type</th>
                <th>Date</th>
                <th>Scam Center</th>
                <th>Carrier</th>
                <th>Scam Verified</th>
                <th>Recording Verification</th>
                <th>API Status</th>
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
                    $(".user-del-btn").click(function () {
                        let r = confirm('Are you sure you want to delete this item?');
                        return (r === true);
                    })
                },
        serverSide: true,
        order: [[ 0, 'desc' ]],
        ajax: "{{ route('scams.index') }}",
        columns: [

            {data: 'checkbox', name: 'checkbox'},
            {data: 'id', name: 'id'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'scam_type', name: 'scam_type'},
            {data: 'call_date', name: 'call_date'},
            {data: 'scam_center_id', name: 'scam_center_id'},
            {data: 'carrier_id', name: 'carrier_id'},
            {data: 'scam_verified', name: 'scam_verified'},
            {data: 'recording', name: 'recording'},
            {data: 'phone_api_status', name: 'phone_api_status'},
            {data: 'action', name: 'action'},
        ],
		columnDefs: [
			{
				orderable: false,
				targets: [0, 10]
			},
			{
				searchable: false,
				targets: [0, 10]
			}
		],
    });


      $('#check_all').on('click', function(e) {
          if($(this).is(':checked',true))
          {
              $(".checkbox").prop('checked', true);
          } else {
              $(".checkbox").prop('checked',false);
          }
      });

      $('.checkbox').on('click',function(){
          if($('.checkbox:checked').length == $('.checkbox').length){
              $('#check_all').prop('checked',true);
          }else{
              $('#check_all').prop('checked',false);
          }
      });

      $('.delete-all').on('click', function(e) {


          var idsArr = [];
          $(".checkbox:checked").each(function() {
              idsArr.push($(this).attr('data-id'));
          });


          if(idsArr.length <=0)
          {
              alert("Please select atleast one record to delete.");
          }  else {

              if(confirm("Are you sure, you want to delete the selected scam phones?")){

                  let strIds = idsArr.join(",");
                    console.log(strIds);
                  $.ajax({
                      type: "POST",
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      dataType: "json",
                      url: '{{URL::to("/")}}/scams/deleteall',
                      data: {ids: strIds},
                      success: function (result) {
                          if(result.status === true){
                              $('.success-message').show();
                              console.log("here i am in side success");
                              $(".success-message").html("<div class='success-message center'>"+result.message+"</div>");
                              setTimeout(function() {
                                  $('.success-message').slideUp("slow");
                              }, 2000);
                              table.ajax.reload();
                          }
                      }
                  });


              }
          }
      });

      $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function (event, element) {
              element.closest('form').submit();
          }
      });


  });
 </script>

<div class="modal fade" id="modal-default" role="dialog">
    @include('scams.partials.import_index')
</div>

@section('scripts')
    @include('scams.partials.create-edit-scripts')
@endsection

<!-- /.modal -->

<style>
    /* CSS used here will be applied after bootstrap.css */
    .modal-dialog{
        overflow-y: initial !important
    }
    .modal-body{
        overflow-y: auto;
    }

</style>
