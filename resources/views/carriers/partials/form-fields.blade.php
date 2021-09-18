<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }}<span style="color:red;"> *</span></label>
        {!! Form::text('company_name',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('company_name') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Email') }}<span style="color:red;"> *</span></label>
        {!! Form::email('email',  null, [
        'class' => 'form-control',
        'required'                      => 'required|email',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Phone') }}<span style="color:red;"> *</span></label>
        {!! Form::text('phone_number',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Scammer Phone') }}<span style="color:red;"> *</span></label>
        {!! Form::select('scammer_phone_id',  $scammerPhones, null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('scammer_phone_id') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Address') }}<span style="color:red;"> *</span></label>
        {!! Form::text('address',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('address') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Country') }}<span style="color:red;"> *</span></label>
        {!! Form::select('country_id',  $countries, null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('country_id') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('City') }}<span style="color:red;"> *</span></label>
        {!! Form::text('city',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('city') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('State') }}<span style="color:red;"> *</span></label>
        {!! Form::text('state',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('state') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Zip') }}<span style="color:red;"> *</span></label>
        {!! Form::text('zip',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('zip') }}</span>
    </div>
</div>
