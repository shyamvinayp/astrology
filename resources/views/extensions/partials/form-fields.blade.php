@if(empty($extension))
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Select') }}</label>
        {{ Form::select('action', ['single' => 'Single', 'bulk' => 'Bulk'], null, [
            "class" => "form-control",
             'required' => 'required',
             'id' => 'bulk-action'
            ]) }}
    </div>
</div>
@endif
<div id="bulk">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Bulk Extension Count') }}</label>
            {!! Form::text('count',  null, [
            'class' => 'form-control',
            'data-parsley-trigger' => 'change focusout',
            'data-parsley-type' => "number",
            'id' => 'bulk-extension'
            ]) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Extension') }}<span style="color:red;"> *</span></label>
        {!! Form::text('name',  null, [
        'class' => 'form-control',
        'required'                      => 'required',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-type' => "number",
         'data-parsley-length' => "[4, 4]",
        ]) !!}
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Status') }}</label>
        {{ Form::select('status', ['0' => 'Unassigned', '1' => 'Assigned'], null, [
            "class" => "form-control",
             'required' => 'required'
            ]) }}
        <span class="text-danger">{{ $errors->first('status') }}</span>
    </div>
</div>

