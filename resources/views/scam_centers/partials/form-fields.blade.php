<div class="row">
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
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Contact Name') }}<span style="color:red;"> *</span></label>
            {!! Form::text('contact_name',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('contact_name') }}</span>
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
            <label for="name" class="col-form-label text-md-right">{{ __('Phone Number') }}<span style="color:red;"> *</span></label>
            {!! Form::text('phone_number',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Country') }}<span style="color:red;"> *</span></label>
            {!! Form::select('country_id',  $countries, null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('country_id') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('City') }}<span style="color:red;"> *</span></label>
            {!! Form::text('city',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('city') }}</span>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('State') }}<span style="color:red;"> *</span></label>
            {!! Form::text('state',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('state') }}</span>
        </div>
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

    <!--Email add remove section start-->



    <div class="col-md-6">

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Email') }}<span style="color:red;"> *</span></label>
            <div class="input-group control-group email-after-add-more">
                <input type="text"  name="email[]" id="ContactNo" class="form-control" placeholder="Email"/>
                <div class="input-group-btn">
                    <button class="btn btn-success email-add-more" type="button"><i class="glyphicon glyphicon-plus">+</i></button>
                </div>
            </div>
        </div>

        @if(!empty($scamcenter->email))
            @foreach(json_decode($scamcenter->email) as $key => $value)
                @if(isset($value))
                    <div class="form-group">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="text" name="email[]" value="{{ $value }}" class="form-control" placeholder="Email"/>
                            <div class="input-group-btn">
                                <button class="btn btn-danger email-remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <div class="email-copy hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="text" name="email[]" class="form-control" placeholder="Email"/>
                <div class="input-group-btn">
                    <button class="btn btn-danger email-remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                </div>
            </div>
        </div>

        <!--Email add remove section end-->

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Skype ID') }}<span style="color:red;"> *</span></label>
            {!! Form::text('skype_id',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('skype') }}</span>
        </div>
        <!--IP Address add remove section start-->
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('IP Address') }}<span style="color:red;"> *</span></label>
            <div class="input-group control-group ip-address-after-add-more">
                <input type="text"  name="ip_address[]" id="ContactNo" class="form-control" placeholder="IP Address"/>
                <div class="input-group-btn">
                    <button class="btn btn-success ip-address-add-more" type="button"><i class="glyphicon glyphicon-plus">+</i></button>
                </div>
            </div>
        </div>
        @if(!empty($scamcenter->ip_address))
            @foreach(json_decode($scamcenter->ip_address) as $key => $value)
                @if(isset($value))
                    <div class="form-group">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="text" name="ip_address[]" value="{{ $value }}" class="form-control" placeholder="IP Address"/>
                            <div class="input-group-btn">
                                <button class="btn btn-danger ip-address-remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <div class="ip-address-copy hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="text" name="ip_address[]" class="form-control" placeholder="IP Address."/>
                <div class="input-group-btn">
                    <button class="btn btn-danger ip-address-remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                </div>
            </div>
        </div>
        <!--IP Address add remove section end-->

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Paypal Address') }}<span style="color:red;"> *</span></label>
            {!! Form::text('paypal_address',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('paypal_address') }}</span>
        </div>

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Scam Type') }}<span style="color:red;"> *</span></label>
            {!! Form::select('scam_type_id', $scamTypes,  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('scam_type_id') }}</span>
        </div>

        <!--media ips add remove section start-->
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Media IP') }}<span style="color:red;"> *</span></label>
            <div class="input-group control-group media-after-add-more">
                <input type="text"  name="media_ips[]" id="ContactNo" class="form-control" placeholder="Media IP"/>
                <div class="input-group-btn">
                    <button class="btn btn-success media-add-more" type="button"><i class="glyphicon glyphicon-plus">+</i></button>
                </div>
            </div>
        </div>

        @if(!empty($scamcenter->media_ips))
            @foreach(json_decode($scamcenter->media_ips) as $key => $value)
                @if(isset($value))
                    <div class="form-group">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="text" name="media_ips[]" value="{{ $value }}" class="form-control" placeholder="Media IP"/>
                            <div class="input-group-btn">
                                <button class="btn btn-danger media-remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        <div class="media-copy hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="text" name="media_ips[]" class="form-control" placeholder="Media IP"/>
                <div class="input-group-btn">
                    <button class="btn btn-danger media-remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                </div>
            </div>
        </div>
        <!--media ips add remove section end-->

        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Customer Reported Scam') }}<span style="color:red;"> *</span></label>
            {!! Form::text('customer_reported_scam',  null, [
            'class' => 'form-control',
            'required'                      => 'required',
            'data-parsley-trigger'          => 'change focusout',
            ]) !!}
            <span class="text-danger">{{ $errors->first('customer_reported_scam') }}</span>
        </div>
    </div>
</div>
