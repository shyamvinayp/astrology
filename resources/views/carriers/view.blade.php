<?php $yesNoOoptions = [''=> '--select--', 'yes' => 'Yes', 'no' => 'No'] ?>
@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>View Carrier Details</h4></div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name :</label>
                            <div class="col-sm-10">
                                {{  $carrier->company_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email :</label>
                            <div class="col-sm-10">
                                {{  $carrier->email }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Carrier Phone :</label>
                            <div class="col-sm-10">
                                {{  $carrier->phone_number }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Scammer Phone :</label>
                            <div class="col-sm-10">
                                {{  $carrier->scammerPhone }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address :</label>
                            <div class="col-sm-10">
                                {{  $carrier->address }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Country :</label>
                            <div class="col-sm-10">
                                {{  $carrier->country_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">State :</label>
                            <div class="col-sm-10">
                                {{  $carrier->state }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">City :</label>
                            <div class="col-sm-10">
                                {{  $carrier->city }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Zip :</label>
                            <div class="col-sm-10">
                                {{  $carrier->zip }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
