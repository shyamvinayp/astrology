@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>

@section('content_header')
@include('partials.content-header', [
	'pageHeadTitle' => 'Customer Register',
	])
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
            @include('flash-message')
                <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Signup Message</h3>
                                </div>
                                <div class="card-body">
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.
                                        The passage is attributed to an unknown typesetter in the 15th century who is thought
                                        to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</p>
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</p>
                                </div>
                            </div>
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
                            <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Signup Form</h3>
                            </div>
                                {!! Form::open(['route'=>'customers.store', 'id' => 'telecom-main-form', 'class' => 'dirtyforms', 'enctype' => "multipart/form-data"]) !!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }}<span style="color:red;"> *</span></label>
                                        {!! Form::text('name', null, [
                                         'class' => 'form-control',
                                         'required'                      => 'required',
                                         'data-parsley-trigger'          => 'change focusout',
                                         ]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}<span style="color:red;"> *</span></label>
                                        {{--  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">--}}
                                        {!! Form::email('email', null, [
                                       'class' => 'form-control',
                                       'required'                      => 'required|email',
                                       'data-parsley-trigger'          => 'change focusout',
                                       ]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}<span style="color:red;"> *</span></label>
                                        {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}
                                        {!! Form::password('password', [
                                         'class' => 'form-control',
                                         'id' => 'password',
                                         'required'                      => 'required',
                                         'data-parsley-trigger'          => 'change focusout',
                                         ]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}<span style="color:red;"> *</span></label>
                                        {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
                                        {!! Form::password('password_confirmation', [
                                        'class' => 'form-control',
                                        'required'                      => 'required',
                                        'data-parsley-equalto' => "#password",
                                        'data-parsley-equalto-message' => "Password and Confirm password does not match!",
                                        'data-parsley-trigger'          => 'change focusout',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-right">{{ __('Customer Type') }}<span style="color:red;"> *</span></label>
                                            {{Form::select('customer_type', $customerType, null, ["class" => "form-control", 'required' => 'required'])}}
                                            <span class="text-danger">{{ $errors->first('customer_type') }}</span>

                                    </div>
                                    <div class="form-group">
                                        <label for="captcha">Captcha Verification</label>
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    </div>
                                    <div class="card-footer mt-20 text-right">
                                            @include('partials.form.save-cancel', ['submitValue'=>"Submit", 'cancelValue' => 'Cancel', 'skipCancel'=> false, 'submitBtnStatus' => 'Primary'])

                                    </div>
                                    {!! Form::close() !!}
                                    <div  class="col-form-label text-md-center">Already an account? <a href="{{  url('/') }}/login">Login</a></div>
                                </div>
                                <!-- /.card-body -->

                        </div>
                    <!--/.col (right) -->
                        </div>
                </div>
                </div>

    </div>
</div>
@endsection

@section('scripts')
    @include('customers.partials.create-edit-scripts')
@endsection
