<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}<span style="color:red;"> *</span></label>
        {!! Form::text('name',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        ]) !!}
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Amount') }}<span style="color:red;"> *</span></label>
        <div class="input-group control-group email-after-add-more">
            <div class="input-group-btn">
                {{Form::select('currency', ['inr' => 'INR', 'usd' => 'USD', 'euro'=>'EURO'], null, ["class" => "form-control", 'required' => 'required'])}}
            </div>

            {!! Form::text('amount',  null, [
              'class' => 'form-control',
              'required'                      => 'required',
              'data-parsley-trigger'          => 'change focusout',
              ]) !!}
            <span class="text-danger">{{ $errors->first('amount') }}</span>
        </div>

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Status') }}</label>
        {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, [
            "class" => "form-control",
             'required' => 'required'
            ]) }}
        <span class="text-danger">{{ $errors->first('status') }}</span>
    </div>
</div>

