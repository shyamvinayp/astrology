@php $prefix = 'tbl_user_';
$user = Auth::user();
@endphp
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('SIP Connection ID') }}<span style="color:red;"> *</span></label>
        {!! Form::text('tbl_sip_connection_id',  $connection->tbl_sip_connection_id, [
          'class' => 'form-control',
          'required'                      => 'required',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        <span class="text-danger">{{ $errors->first('tbl_sip_connection_id') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}<span style="color:red;"> *</span></label>
        {!! Form::text('tbl_sip_connection_name',  $connection->tbl_sip_connection_name, [
          'class' => 'form-control',
          'required'                      => 'required',
          'data-parsley-trigger'          => 'change focusout',
          ]) !!}
        <span class="text-danger">{{ $errors->first('tbl_sip_connection_name') }}</span>
    </div>
</div>

<div class="clearfix exhibitors-wrap " style="max-width: 1025px;margin-bottom:15px;">
    <div class="col-md-6">
        <label for="name" class="col-form-label text-md-right">{{ __('SIP Connection Type:') }}</label>
        <div style="border: 1px solid darkgrey; height:100px; padding:5px; width: 525px;">

            <div {{--style="border: 1px solid #eeeeee; height: 100px; padding-top: 20px; padding-left: 10px;"--}}>
                <div class="form-group">
                    {{--<div class="fake-label">Venue Type</div>--}}
                    <div class="row">
                        @foreach($connectionTypes as $typeKey => $typeValue)
                            <div class="col-sm-4">
                                @include('partials.form.checkbox-group', [
                                    'field' => 'tbl_connection_type',
                                    'fieldType' => 'radio',
                                    'attrs' => ['id' => strtolower(str_replace(' ', '_', $typeValue))],
                                    'text' => $typeValue,
                                    'chValue' => $typeKey,
                                ])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="credentials-content">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-md-right">{{ __('Username') }}<span style="color:red;"> *</span></label>
                {!! Form::text('directory[username]',  !empty($directory && $directory->username) ? $directory->username:null, [
                  'class' => 'form-control',
                  'required'                      => 'required',
                  'data-parsley-trigger'          => 'change focusout',
                  ]) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}<span style="color:red;"> *</span></label>
                {!! Form::input('password', 'directory[password]', !empty($directory && $directory->password) ? $directory->password:null, [
                    'value' => !empty($directory && $directory->password) ? $directory->password:null,
                    'class' => 'form-control',
                    'id' => 'password',
                    'required'                      => 'required',
                    'data-parsley-trigger'          => 'change focusout',
                 ]) !!}
            </div>
        </div>
    </div>

    <div id="ip_address-content">
        @if(!empty($connectionIps))
            @foreach($connectionIps as $key => $value)
                @if(isset($value))
                <div class="col-md-6">
                    <div class="copy1 hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="text" name="tbl_connection_ips[]" value="{{ $value["param:proxy"] }}" class="form-control" placeholder="Enter Other IP Address.">
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif

        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-md-right">{{ __('IP Address') }}<span style="color:#ff0000;"> *</span></label>
                    <div class="input-group control-group after-add-more">
                        <input type="text"  name="tbl_connection_ips[]" id="ContactNo" class="form-control" placeholder="Enter IP Address"/>

                        <div class="input-group-btn">
                            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus">+</i></button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="copy hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="text" name="tbl_connection_ips[]" class="form-control" placeholder="Enter Other IP Address."/>
                <div class="input-group-btn">
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove">-</i></button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-md-right">{{ __('Tech Prefix') }}</label>
                {!! Form::text('tbl_connection_ip_techprefix',  null, [
                  'class' => 'form-control',
                  ]) !!}
                <span class="text-danger">{{ $errors->first('tbl_connection_ip_techprefix') }}</span>
            </div>
        </div>

    </div>


    <div id="uri-content">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-md-right">{{ __('URI') }}</label>
                {!! Form::text('tbl_connection_uri',  null, [
                  'class' => 'form-control',
                  ]) !!}
                <span class="text-danger">{{ $errors->first('tbl_connection_uri') }}</span>
            </div>
        </div>
    </div>

    <div id="forward-content">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-md-right">{{ __('Phone') }}<span style="color:red;"> *</span></label>
                {!! Form::text('tbl_connection_phone', null, [
                  'class' => 'form-control',
                  'data-parsley-type'             =>  "number",
                  'data-parsley-trigger'          => 'change focusout',
                  ]) !!}
                <span class="text-danger">{{ $errors->first('tbl_connection_phone') }}</span>
            </div>
        </div>
    </div>
</div>
