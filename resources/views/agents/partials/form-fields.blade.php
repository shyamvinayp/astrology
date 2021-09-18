<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('First Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('fname',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('fname') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Middel Name') }}</label>
            {!! Form::text('mname',  null, [
            'class' => 'form-control',
            ]) !!}
            <span class="text-danger">{{ $errors->first('mname') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Last Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('lname',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('lname') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Date of Birth') }}<span style="color:red;"> *</span></label>
            {!! Form::date('dob',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('dob') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Sex') }}<span style="color:red;"> *</span></label>
            {!! Form::select('sex',  ['male' => 'Male', 'female'=>'Female'], null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('sex') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Highest Education') }}<span style="color:red;"> *</span></label>
            {!! Form::text('education',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('education') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Address') }}<span style="color:red;"> *</span></label>
            {!! Form::text('address',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Mobile Number') }}<span style="color:red;"> *</span></label>
            {!! Form::text('mobile',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('mobile') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Alternate Number') }}</label>
            {!! Form::text('alternate_phone',  null, [
            'class' => 'form-control',
            ]) !!}
            <span class="text-danger">{{ $errors->first('alternate_phone') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Astrology Category') }}<span style="color:red;"> *</span></label>
            {!! Form::select('category_id', $categories,  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Extension') }}<span style="color:red;"> *</span></label>
            {!! Form::select('extension', $extensions,  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('extension') }}</span>
        </div>

    </div>

    <!--Email add remove section start-->

    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Email') }}<span style="color:red;"> *</span></label>
            {!! Form::email('email',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Password') }}<span style="color:red;"> *</span></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
       {{-- <div><h4>Bank Details</h4></div>--}}
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">&nbsp;</label>
            <div style="background-color: lightgrey; padding:3px;"><h4>Bank Details</h4></div>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Account No') }}<span style="color:red;"> *</span></label>
            {!! Form::text('account_number',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('account_number') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Bank Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('bank_name',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('bank_name') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Branch Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('branch_name',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('branch_name') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('IFSC Code') }}<span style="color:red;"> *</span></label>
            {!! Form::text('ifsc_code',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('ifsc_code') }}</span>
        </div>
        {{--<div><h4>Document Uploads</h4></div>--}}
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">&nbsp;</label>
            <div style="background-color: lightgrey; padding:2px;"><h4>Document Uploads</h4></div>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Resume') }}<span style="color:red;"> *</span></label>
            {!! Form::file('resume',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('resume') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Photo') }}<span style="color:red;"> *</span></label>
            {!! Form::file('image',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('image') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Pancard') }}<span style="color:red;"> *</span></label>
            {!! Form::file('id_pancard',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('id_pancard') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Adharcard') }}<span style="color:red;"> *</span></label>
            {!! Form::file('id_adharcard',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('id_adharcard') }}</span>
        </div>

    </div>
</div>
