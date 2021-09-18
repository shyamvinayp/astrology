<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Agency Name') }}<span style="color:red;"> *</span></label>
        {!! Form::text('agency_name',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('agency_name') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Contact Name') }}<span style="color:red;"> *</span></label>
        {!! Form::text('contact_name',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('contact_name') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Contact Email') }}<span style="color:red;"> *</span></label>
        {!! Form::email('contact_email',  null, [
        'class' => 'form-control',
        'required'                      => 'required|email',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('contact_email') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Contact Phone') }}<span style="color:red;"> *</span></label>
        {!! Form::text('contact_phone',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Report Scam Email') }}</label>
        {!! Form::email('email_report_scam',  null, [
        'class' => 'form-control',
        ]) !!}
        <span class="text-danger">{{ $errors->first('email_report_scam') }}</span>
    </div>
</div>
