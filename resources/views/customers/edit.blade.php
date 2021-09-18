@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
	@include('flash-message')
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">

                    {!! Form::model($user, ['url'=>route('customers.update',$user->id), 'id' => 'telecom-main-form', 'class' => 'dirtyforms', 'enctype' => "multipart/form-data"]) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span style="color:red;"> *</span></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_1" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}<span style="color:red;"> *</span></label>
                            <div class="col-md-6">
                                {!! Form::text('address', null, [
                                  'class' => 'form-control',
                                  'required'                      => 'required',
                                  'data-parsley-trigger'          => 'change focusout',
                                  ]) !!}
                                <span class="text-danger">{{ $errors->first('address_1') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}<span style="color:red;"> *</span></label>
                            <div class="col-md-6">
                               {{Form::select('country_id', $countries, null, ["class" => "form-control", 'required' => 'required'])}}
                                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_1" class="col-md-4 col-form-label text-md-right">{{ __('City') }}<span style="color:red;"> *</span></label>
                            <div class="col-md-6">
                                {!! Form::text('city', null, [
                                  'class' => 'form-control',
                                  'required'                      => 'required',
                                  'data-parsley-trigger'          => 'change focusout',
                                  ]) !!}
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_1" class="col-md-4 col-form-label text-md-right">{{ __('State') }}<span style="color:red;"> *</span></label>
                            <div class="col-md-6">
                                {!! Form::text('state', null, [
                                   'class' => 'form-control',
                                   'required'                      => 'required',
                                   'data-parsley-trigger'          => 'change focusout',
                                   ]) !!}
                                <span class="text-danger">{{ $errors->first('state') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_1" class="col-md-4 col-form-label text-md-right">{{ __('Zip') }}<span style="color:red;"> *</span></label>
                            <div class="col-md-6">
                                {!! Form::text('zip', null, [
                                   'class' => 'form-control',
                                   'required'                      => 'required',
                                   'data-parsley-trigger'          => 'change focusout',
                                   ]) !!}
                                <span class="text-danger">{{ $errors->first('zip') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Customer Type') }}</label>
                            <div class="col-md-6">
                                {{Form::select('customer_type', $customerType, null, ["class" => "form-control", 'required' => 'required'])}}
                                <span class="text-danger">{{ $errors->first('customer_type') }}</span>
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
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
