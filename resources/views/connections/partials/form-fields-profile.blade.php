@php $prefix = 'tbl_user_' @endphp
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="utility_bill" class="col-form-label text-md-right">{{ __('Proof of address (utility bill such as electricity)') }}<span style="color:red;"> *</span></label>

            {!! Form::file($prefix.'utility_bill', null, [
          'class' => 'form-control',
          'required'                      => 'required',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="photo_id" class="col-form-label text-md-right">{{ __('Photo ID') }}<span style="color:red;"> *</span></label>
            <br />
            {!! Form::file($prefix.'photo_id', null, [
          'class' => 'form-control',
          'required'                      => 'required',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('tbl_user_terms') ? ' has-error' : '' }} clearfix">
            <label for="utility_bill" class="col-form-label text-md-right"><span style="color:red;"> *</span> Agree with the <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                    terms and conditions
                </button>
            {{ Form::checkbox($prefix.'terms', null, old('tbl_user_terms'), ["class" => "icheck-primary d-inline ml-4", 'required'=> true]) }}
            @if ($errors->has('tbl_user_terms'))
                <div class="col-md-4">
                    <span class="help-block">
                       <strong>{{ $errors->first('tbl_user_terms') }}</strong>
                     </span>
                </div>
            @endif

        </div>

    </div>
</div>
{{--@include('partials.form.captcha-group')--}}


<div class="modal fade" id="modal-default">
    <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Terms & Conditions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>We value your privacy
                    We and our partners store and/or access information on a device, such as cookies and process personal data, such as unique identifiers and standard information sent by a device for personalised ads and content, ad and content measurement, and audience insights, as well as to develop and improve products.

                    With your permission we and our partners may use precise geolocation data and identification through device scanning. You may click to consent to our and our partners’ processing as described above. Alternatively you may click to refuse to consent or access more detailed information and change your preferences before consenting. Please note that some processing of your personal data may not require
                    your consent, but you have a right to object to such processing. Your preferences will apply to this website only.</p>
                <p>We value your privacy
                    We and our partners store and/or access information on a device, such as cookies and process personal data, such as unique identifiers and standard information sent by a device for personalised ads and content, ad and content measurement, and audience insights, as well as to develop and improve products.

                    With your permission we and our partners may use precise geolocation data and identification through device scanning. You may click to consent to our and our partners’ processing as described above. Alternatively you may click to refuse to consent or access more detailed information and change your preferences before consenting. Please note that some processing of your personal data may not require
                    your consent, but you have a right to object to such processing. Your preferences will apply to this website only.</p>
                <p>We value your privacy
                    We and our partners store and/or access information on a device, such as cookies and process personal data, such as unique identifiers and standard information sent by a device for personalised ads and content, ad and content measurement, and audience insights, as well as to develop and improve products.

                    With your permission we and our partners may use precise geolocation data and identification through device scanning. You may click to consent to our and our partners’ processing as described above. Alternatively you may click to refuse to consent or access more detailed information and change your preferences before consenting. Please note that some processing of your personal data may not require
                    your consent, but you have a right to object to such processing. Your preferences will apply to this website only.</p>
                <p>We value your privacy
                    We and our partners store and/or access information on a device, such as cookies and process personal data, such as unique identifiers and standard information sent by a device for personalised ads and content, ad and content measurement, and audience insights, as well as to develop and improve products.

                    With your permission we and our partners may use precise geolocation data and identification through device scanning. You may click to consent to our and our partners’ processing as described above. Alternatively you may click to refuse to consent or access more detailed information and change your preferences before consenting. Please note that some processing of your personal data may not require
                    your consent, but you have a right to object to such processing. Your preferences will apply to this website only.</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<style>
    /* CSS used here will be applied after bootstrap.css */
    .modal-dialog{
        overflow-y: initial !important
    }
    .modal-body{
        height: 250px;
        overflow-y: auto;
    }

</style>
