@php $prefix = 'tbl_user_' ;

@endphp

@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-sm-12">
                <div class="card">
                    {{--page header nav--}}
                    @include('customers.left-tabs.page-header-nav', ['numbers_tabs' => ['My Numbers', 'Order Numbers','Porting Numbers','Order History','Pricing']])
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="my-numbers">
                                My Numbers Content
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="order-numbers">
                                Order Numbers Content
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="porting-numbers">
                               Porting Numbers Content
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="order-history">
                                Order History Content
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="pricing">
                                Pricing Content
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('customers.partials.create-edit-scripts')
@endsection
