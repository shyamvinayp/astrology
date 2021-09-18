<?php $phoneCode = ['1' => '1'] ?>
@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Report a scam call</h4></div>
                        <div class="card-body">
                        {!! Form::model(null, ['url'=>route('scams.store'), 'files' => true, 'id' => 'telecom-main-form', 'class' => 'dirtyforms']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Phone Number') }}<span style="color:red;"> *</span></label>
                                        <div class="input-group control-group email-after-add-more">
                                            <div class="input-group-btn">
                                                {{Form::select('phone_code', $phoneCode, null, ["class" => "form-control", 'required' => 'required'])}}
                                            </div>

                                            {!! Form::text('phone_number',  null, [
                                            'class' => 'form-control',
                                            'required'                      => 'required',
                                             'data-parsley-type'            => 'number',
                                            "data-parsley-length"                 => '[10, 10]',
                                            "data-parsley-length-message"           =>  "Phone number should be 10 digit long",
                                            'data-parsley-type'            => 'number',
                                            'data-parsley-trigger'          => 'blur',
                                            ]) !!}
                                            <span class="text-danger">{{ $errors->first('scam_type_id') }}</span>
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Scam Type') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('scam_type_id', $scamTypes, null, ["class" => "form-control", 'required' => 'required'])}}
                                    <span class="text-danger">{{ $errors->first('scam_type_id') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Call Date') }}<span style="color:red;"> *</span></label>
                                    <input type="date" class="form-control parsley-error" id="example-date-input" required="required" name="call_date" data-parsley-id="11" aria-describedby="parsley-id-11">
                                    <span class="text-danger">{{ $errors->first('call_date') }}</span>
                                </div>
                            </div>
                           {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country_id" class="ccol-form-label text-md-right">{{ __('Scam Verified (Yes/No)') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('scam_verified', $yesNoOoptions, null, ["class" => "form-control", 'required' => 'required'])}}
                                    <span class="text-danger">{{ $errors->first('scam_verified') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country_id" class="ccol-form-label text-md-right">{{ __('recording Verification (Yes/No)') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('recording_verification', $yesNoOoptions, null, ["class" => "form-control", 'required' => 'required'])}}
                                    <span class="text-danger">{{ $errors->first('recording_verification') }}</span>

                                </div>
                            </div>--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Notes') }}</label>
                                    {!! Form::textarea('notes',  null, [
                                    'class' => 'form-control',
                                    /*'required'                      => 'required',
                                    'data-parsley-trigger'          => 'change focusout',*/
                                    'rows'                          => "4",
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                                </div>
                            </div>

                            <div class="row mt-20 text-right">
                            <div class="col-sm-12">
                                @include('partials.form.save-cancel', ['submitValue'=>"Submit", 'cancelValue' => 'Cancel', 'skipCancel'=> false, 'submitBtnStatus' => 'Primary'])
                            </div>
                            </div>
                        {!! Form::close() !!}
                        </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('customers.partials.create-edit-scripts')
@endsection

