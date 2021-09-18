<?php $yesNoOoptions = [''=> '--select--', 'yes' => 'Yes', 'no' => 'No'] ?>
@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    @include('scams.partials.page-header-nav', ['numbers_tabs' => ['Edit Scam Phone', 'User Report History', 'Detailed Number Info', 'Notes']])
                    {{--<div class="card-header"><h4>Edit Scam Phone</h4></div>--}}
                    <div class="card-body">
                        <div class="tab-pane active" id="edit-scam-phone">
                            {!! Form::model($scamPhone, ['url'=>route('scams.update',$scamPhone->id), 'id' => 'telecom-main-form', 'class' => 'dirtyforms', 'enctype' => "multipart/form-data"]) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Phone Number') }}<span style="color:red;"> *</span></label>
                                    {!! Form::text('phone_number',  null, [
                                    'class' => 'form-control',
                                     'data-parsley-type'            => 'number',
                                    'readonly'                      => true,
                                    'data-parsley-trigger'          => 'change focusout',
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
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
                                    <label for="name" class="col-form-label text-md-right">{{ __('Call Date Time') }}<span style="color:red;"> *</span></label>
                                    <input type="date" readonly = true class="form-control parsley-error" id="game-date-time-text" required="required" name="call_date" value="{{ isset($scamPhone->call_date) ? $scamPhone->call_date : null }}" data-parsley-id="11" aria-describedby="parsley-id-11">
                                    <span class="text-danger">{{ $errors->first('call_date') }}</span>
                                </div>
                            </div>
                           {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Notes') }}<span style="color:red;"> *</span></label>
                                    {!! Form::textarea('notes',  null, [
                                    'class' => 'form-control',
                                    'required'                      => 'required',
                                    'data-parsley-trigger'          => 'change focusout',
                                    'rows'                          => "5",
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                                </div>
                            </div>--}}
                            <div class="col-md-6">
                                <div class="rounded" style="background-color: darkgrey; padding:10px; margin-bottom: 10px; font-weight: bold; size: A4;">Update Scam Status</div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Scam Center') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('scam_center_id', $scamcenters, null, ["class" => "form-control"])}}
                                    <span class="text-danger">{{ $errors->first('scam_center_id') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Carrier') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('carrier_id', $carriers, null, ["class" => "form-control"])}}
                                    <span class="text-danger">{{ $errors->first('carrier_id') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country_id" class="ccol-form-label text-md-right">{{ __('Scam Verified (Yes/No)') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('scam_verified', $yesNoOoptions, null, ["class" => "form-control", 'required' => 'required'])}}
                                    <span class="text-danger">{{ $errors->first('scam_verified') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country_id" class="ccol-form-label text-md-right">{{ __('Recording Verification (Yes/No)') }}<span style="color:red;"> *</span></label>
                                    {{Form::select('recording_verification', $yesNoOoptions, null, ["class" => "form-control", 'required' => 'required'])}}
                                    <span class="text-danger">{{ $errors->first('recording_verification') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo_id" class="col-form-label text-md-right">{{ __('Verifiecation Recording') }}<span style="color:red;"> *</span></label>
                                    <br />
                                    {!! Form::file('verification_audio', null, [
                                  'class' => 'form-control',
                                  'required'                      => 'required',
                                  'data-parsley-fileextension' => 'mp3',
                                  'data-parsley-trigger'          => 'change focusout',
                                  ]) !!}
                                </div>
                                @if(isset($scamPhone->verification_audio))
                                    <audio controls>
                                        <source src="{{ url('public/upload/verifications/'.$scamPhone->verification_audio) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif
                            </div>

                            <div class="row mt-20 text-right">
                                <div class="col-sm-12">
                                    @include('partials.form.save-cancel', ['submitValue'=>"Update", 'cancelValue' => 'Cancel', 'skipCancel'=> false, 'submitBtnStatus' => 'Primary'])
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="tab-pane active" id="phone-history">
                            {{--<div><h4>User Report History</h4></div>--}}
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th width="30px">ID</th>
                                    <th width="150px">Phone Number</th>
                                    <th width="170px">Created/Updated By</th>
                                    <th>Message</th>
                                    <th width="200px">Created Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($phoneHistory) && count($phoneHistory) > 0)
                                        @foreach($phoneHistory as $history)
                                            <tr>
                                                <td width="30px">{{ $history->id }}</td>
                                                <td width="150px">{{ $history->phone_number }}</td>
                                                <td width="170px">{{ $history->name }}</td>
                                                <td>{{ $history->message }}</td>
                                                <td width="200px">{{ $history->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td style="text-align: center;" colspan="5">"No user history found!"</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane active" id="phone-info">
                            {{--<div><h4>Detailed Number Info</h4></div >--}}
                            @if(!empty($phoneApiDetails))
                                @foreach($phoneApiDetails['data'] as $key => $value)
                                    @if(is_array($value))
                                        @foreach($value as $key1 => $value1)
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ ucwords(str_replace("_", " ", $key1)) }} :</label>
                                                <div class="col-sm-10">
                                                    {{  $value1 }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif(!is_array($key) && !is_array($value))
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ ucwords(str_replace("_", " ", $key)) }} :</label>
                                            <div class="col-sm-10">
                                                {{  $value }}
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            @else
                                <div><h5>No details found!</h5></div >
                            @endif
                        </div>

                        <div class="tab-pane active" id="notes">
                            <p>
                                {{ $scamPhone->notes }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('scams.partials.create-edit-scripts')
@endsection

