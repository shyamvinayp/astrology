@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>
<style>

</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('flash-message')
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">{{ __('Add User') }}</div>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST','url' => route('users.store'), 'data-parsley-validate', 'id' => 'telecom-main-form']) !!}
					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('name', null, [
                                  'class' => 'form-control',
                                  'required'                      => 'required',
                                  'data-parsley-trigger'          => 'change focusout',
                                  ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                              {!! Form::email('email', null, [
                                  'class' => 'form-control',
                                  'placeholder'                   => 'email@example.com',
                                  'required'                      => 'required',
                                  'data-parsley-required-message' => 'Email name is required',
                                  'data-parsley-trigger'          => 'change focusout',
                                  ]) !!}
                            </div>
                        </div>

						<div class="form-group row">
						{{Form::label('usertype', 'User Type', ['class' => 'col-md-4 col-form-label text-md-right'])}}
						<div class="col-md-6">
						{{Form::select('user_id',$userType, null, ["class" => "form-control", 'required' => 'required'])}}
						</div>
						 </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('password', null, [
                                  'class' => 'form-control',
                                  'id' => 'password',
                                  'type' => "password",
                                  'required' => 'required',
                                  'data-parsley-equalto'=>"#password_c",
                                  'data-parsley-trigger' => 'change focusout',
                                  ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <!--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">-->
                                {!! Form::text('password_confirmation', null, [
                                     'class' => 'form-control',
                                     'id' => 'password_c',
                                     'type' => "password",
                                     'required' => 'required',
                                     'data-parsley-equalto'=>"#password",
                                     'data-parsley-trigger' => 'change focusout',
                                     ]) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
    @include('users.partials.create-edit-scripts')
@endsection
