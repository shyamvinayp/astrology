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
        <label for="name" class="col-form-label text-md-right">{{ __('Amount') }}<span style="color:red;"> *</span></label>
        <div class="input-group control-group email-after-add-more">
            <div class="input-group-btn">
                {{Form::select('currency', ['inr' => 'INR', 'dollor' => 'DOLLOR', 'euro'=>'EURO'], null, ["class" => "form-control", 'required' => 'required'])}}
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
        <label for="name" class="col-form-label text-md-right">{{ __('Description') }}</label>
        {!! Form::textarea('description', null, [
          'class' => 'form-control',
          'rows' => '5',
          'max-lenght'                      => '2000',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('User Image') }}</label>
        {!! Form::file('image', null, [
          'class' => 'form-control',
          'required'                      => 'required',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        <span class="text-danger">{{ $errors->first('image') }}</span>
    </div>
</div>

