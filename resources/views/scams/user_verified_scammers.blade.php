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
<h1>Verified Scammer List</h1>
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
                <th>ID</th>
                <th>Phone Number</th>
                <th>Scam Type</th>
                <th>Date</th>
                <th>Scam Verified</th>
                <th width="100px">Click to Call</th>
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

                    $(".btnConfig12").click(function() {
                        let scamPhonNumber = this.id;
                        //let sipIDPass = this.data_container;
                        //console.log(scamPhonNumber);
                        //alert(sipIDPass)
                        //$('#numDisplay').val(scamPhonNumber);
                        //console.log("scam number: "+scamPhonNumber);
                        //alert( "Handler for .click() called.shyam" );
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
                        valid = true;
                        if (valid) {
                            //alert("herllo testing");
                            //alert(JSON.stringify(user));
                            localStorage.setItem('SIPCreds', JSON.stringify(user));
                            let url      = 'https://45.76.9.44/webphone/phone?phone_number='+scamPhonNumber,
                            //let url      = 'https://45.76.9.44/phone/',
                                features = 'menubar=no,location=no,resizable=no,scrollbars=no,status=no,addressbar=no,width=320,height=480';
                            console.log(url);
                            if (!localStorage.getItem('ctxPhone')) {
                                window.open(url, 'ctxPhone', features);
                               // $('#mdlDemo').modal('hide');
                                return false;
                            } else {
                                window.alert('Phone already open.');
                            }
                        }

                    });

                },
        serverSide: true,
        order: [[ 3, 'desc' ], [ 0, 'asc' ]],
        ajax: "{{ route('scams.verifiedScammer') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'scam_type', name: 'scam_type'},
            {data: 'call_date', name: 'call_date'},
            {data: 'scam_verified', name: 'scam_verified'},
            {data: 'action', name: 'action'},
        ],
		columnDefs: [
			{
				orderable: false,
				targets: [5]
			},
			{
				searchable: false,
				targets: [5]
			}
		],
    });




  });
 </script>

    {{--
<div class="modal fade" id="mdlDemo" role="dialog">
    @include('scams.partials.phone_number')
</div>--}}

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
