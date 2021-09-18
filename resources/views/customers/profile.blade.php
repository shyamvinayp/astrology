@php $prefix = 'tbl_user_' ;

@endphp

@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header"><h4>Customer Profile</h4></div>--}}
                    {{--page header nav--}}
                    @include('customers.left-tabs.page-header-nav', ['numbers_tabs' => ['Account Info', 'Billing', 'Security']])
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                {!! Form::model($user, ['url'=>route('customers.update',$user->id), 'files' => true, 'id' => 'telecom-main-form', 'class' => 'dirtyforms']) !!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('customers.partials.form-fields')
                                <div class="row mt-20 text-right">
                                    <div class="col-sm-12">
                                        @include('partials.form.save-cancel', ['submitValue'=>"Save", 'cancelValue' => 'Cancel', 'skipCancel'=> false, 'submitBtnStatus' => 'Primary'])
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane active" id="timeline">
                                Billings content
                            </div>
                            <div class="tab-pane active" id="settings">
                                Security content
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('customers.partials.create-edit-scripts')
@endsection
