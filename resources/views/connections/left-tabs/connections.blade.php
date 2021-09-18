@extends('adminlte::page')

{{--
@section('content_header')
@include('flash-message')
<h1>SIP Connections</h1>
@stop
--}}

@section('content_header')
    @include('partials.content-header', [
        'pageHeadTitle' => 'SIP Connections',
        'breadcrumbs' => Breadcrumbs::render('customers.connections'),
		 'headerBtns' => [
            'btn1' => [
                 'id' => "add-sip-connection",
                'text' => "Add SIP Connection",
                'href' => route('customers.connections'),

            ]
        ]
        ])
@endsection

@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th width="100px">ID</th>
                <th>SIP Connection Name</th>
                <th>Type</th>
                <th>Status</th>
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
              $(".connection-active-btn").click(function () {
                  let r = confirm('Are you sure you want to change the status of this connection?');
                  return (r === true);
              })
          },
          serverSide: true,
          ajax: "{{ route('customers.connections') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'tbl_sip_connection_name', name: 'tbl_sip_connection_name'},
              {data: 'type', name: 'type'},
              {data: 'status', name: 'status'},
              {
                  mRender: function (data, type, row) {
                      return '<div class="text-center" style="width:100%; min-width:80px"> ' +
                          '<a href="/sipnected_new/customers/connections/' + row.id + '/edit"   class="btn btn-xs btn-info" style="padding: 8px 13px;"><i class="fa fa-edit"></i></a>';
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


      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus',
              data: {'status': status, 'user_id': user_id},
              success: function(data){
                  console.log(data.success)
              }
          });
      })

  });
 </script>


<div class="modal fade" id="modal-default">
    @include('customers.left-tabs.add-connection')
</div>
</div>
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
