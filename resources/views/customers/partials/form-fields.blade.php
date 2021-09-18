<div class="card card-secondary"><h4>Contact Section</h4></div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('name',  $user->name, [
              'class' => 'form-control',
              'required'                      => 'required',
              'data-parsley-trigger'          => 'change focusout',
              ]) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="fname" class="col-form-label text-md-right">{{ __('First Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('fname', null, [
              'class' => 'form-control',
              'required'                      => 'required',
              'data-parsley-trigger'          => 'change focusout',
              ]) !!}
            <span class="text-danger">{{ $errors->first('fname') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lname" class="col-form-label text-md-right">{{ __('Last Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('lname', null, [
                'class' => 'form-control',
                'required'                      => 'required',
                'data-parsley-trigger'          => 'change focusout',
                ]) !!}
            <span class="text-danger">{{ $errors->first('lname') }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="address_1" class="col-form-label text-md-right">{{ __('Address 1') }}</label>
            {!! Form::text('address', null, [
              'class' => 'form-control',
              ]) !!}
            <span class="text-danger">{{ $errors->first('address_1') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="address_2" class="col-form-label text-md-right">{{ __('Address 2') }}</label>
            {!! Form::text('address_2', null, [
              'class' => 'form-control',
              ]) !!}
            <span class="text-danger">{{ $errors->first('address_2') }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="country_id" class="ccol-form-label text-md-right">{{ __('Country') }}<span style="color:red;"> *</span></label>
            {{Form::select('country_id', $countries, null, ["class" => "form-control", 'required' => 'required'])}}
            <span class="text-danger">{{ $errors->first('country_id') }}</span>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="city" class="col-form-label text-md-right">{{ __('City') }}<span style="color:red;"> *</span></label>
            {!! Form::text('city', null, [
              'class' => 'form-control',
              'required'                      => 'required',
              'data-parsley-trigger'          => 'change focusout',
              ]) !!}
            <span class="text-danger">{{ $errors->first('city') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="zip" class="col-form-label text-md-right">{{ __('State') }}<span style="color:red;"> *</span></label>
            {!! Form::text('state', null, [
              'class' => 'form-control',
              'required'                      => 'required',
              'data-parsley-trigger'          => 'change focusout',
              ]) !!}
            <span class="text-danger">{{ $errors->first('state') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="zip" class="col-form-label text-md-right">{{ __('Zip Code') }}<span style="color:red;"> *</span></label>
            {!! Form::text('zip', null, [
              'class' => 'form-control',
              'required'                      => 'required',
              'data-parsley-trigger'          => 'change focusout',
              ]) !!}
            <span class="text-danger">{{ $errors->first('zip') }}</span>
        </div>
    </div>
</div>

<div class="card card-secondary"><h4>Email Section</h4></div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}<span style="color:red;"> *</span></label>
            {{--  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">--}}
            {!! Form::email('email', $user->email, [
           'class' => 'form-control',
           'required'                      => 'required|email',
           'data-parsley-trigger'          => 'change focusout',
           ]) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="col-form-label text-md-right">{{ __('Billing Email') }}<span style="color:red;"> *</span></label>
            {{--  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">--}}
            {!! Form::email('billing_email', null, [
           'class' => 'form-control',
           'required'                      => 'required|email',
           'data-parsley-trigger'          => 'change focusout',
           ]) !!}
            <span class="text-danger">{{ $errors->first('billing_email') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="col-form-label text-md-right">{{ __('Rates Email') }}<span style="color:red;"> *</span></label>
            {{--  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">--}}
            {!! Form::email('rate_email', null, [
           'class' => 'form-control',
           'required'                      => 'required|email',
           'data-parsley-trigger'          => 'change focusout',
           ]) !!}
            <span class="text-danger">{{ $errors->first('rate_email') }}</span>
        </div>
    </div>
</div>

{{--<div class="card card-secondary"><h4>Document Section</h4></div>
@include('customers.partials.form-fields-profile')--}}

