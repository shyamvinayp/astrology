<?php $yesNoOoptions = [''=> '--select--', 'yes' => 'Yes', 'no' => 'No'] ?>
@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>View Scam Center Details</h4></div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->company_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Name :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->contact_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->address }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->phone_number }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Country :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->country_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">City :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->city }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">State :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->state }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Zip :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->zip }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email :</label>
                            @if(isset($scamcenter->email))
                            <div class="col-sm-10">
                                {{  $scamcenter->email }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Skype ID :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->skype_id }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">IP Address :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->ip_address }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Paypal Address :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->paypal_address }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Scam Type :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Media IP :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->media_ips }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Customer Reported Scam :</label>
                            <div class="col-sm-10">
                                {{  $scamcenter->customer_reported_scam }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
