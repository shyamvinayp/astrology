@php $status = ['1' => 'Active', '0' => 'Inactive'] @endphp
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Caller Group') }}<span style="color:red;"> *</span></label>
    <div class="col-md-6">
        {{Form::select('tbl_callerid_gp_id', $callergroup, null, ["class" => "form-control", 'required' => 'required'])}}
        <span class="text-danger">{{ $errors->first('tbl_callerid_gp_id') }}</span>
    </div>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Caller ID') }}<span style="color:red;"> *</span></label>
    <div class="col-md-6">
        {!! Form::text('tbl_callerid', null, [
           'class' => 'form-control',
           'required'                      => 'required',
           'data-parsley-trigger'          => 'change focusout',
           ]) !!}
        <span class="text-danger">{{ $errors->first('tbl_callerid') }}</span>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Caller Desc') }}<span style="color:red;"> *</span></label>
    <div class="col-md-6">
        {{Form::textarea('tbl_callerid_desc', null, ["class" => "form-control", 'required' => 'required', 'rows'=> 4])}}
        <span class="text-danger">{{ $errors->first('tbl_callerid_desc') }}</span>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}<span style="color:red;"> *</span></label>
    <div class="col-md-6">
    {{Form::select('tbl_callerid_status', $status, null, ["class" => "form-control", 'required' => 'required'])}}
    <span class="text-danger">{{ $errors->first('tbl_callerid_status') }}</span>
    </div>
</div>





