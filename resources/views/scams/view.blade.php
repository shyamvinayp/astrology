<?php $yesNoOoptions = [''=> '--select--', 'yes' => 'Yes', 'no' => 'No'] ?>
@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>View Scam Phone Details</h4></div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->phone_number }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Scam Type :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Call Date Time :</label>
                            <div class="col-sm-10">
                                {{  date("d-m-Y h:i:s", strtotime($scamPhone->call_date)) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Notes :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->notes }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Scam Center :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->centerName }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Carrier :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->carrierName }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Scam Verified :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->scam_verified }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Recording Verification :</label>
                            <div class="col-sm-10">
                                {{  $scamPhone->recording_verification }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="photo_id" class="col-form-label text-md-right">{{ __('Verifiecation Recording') }}<span style="color:red;"> *</span></label>

                            </div>
                            @if(isset($scamPhone->verification_audio))
                                <audio controls>
                                    <source src="{{ url('public/upload/verifications/'.$scamPhone->verification_audio) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
