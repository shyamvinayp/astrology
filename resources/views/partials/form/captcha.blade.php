@if(config('app.env') === 'local1')
      <div class="col-md-3 col-md-offset-3 text-left ">
       <div class="sy-img-wrap  w-300 h-75 clearfix" style="background-image: url('http://smartadmincenter.lan/images/smartadmincenter/google-captcha-fake.png');">
           <img src="{{url('/img/google-captcha-fake.png')}}" alt="Image"/>
           <div class="sy-img-text-wrap text-center mt-30 "></div>
       </div>
   </div>
@else
    <div class="captcha-wrap {!! $errors->has('g-recaptcha-response')?'has-error':'' !!}">
        {!! NoCaptcha::display() !!}
        @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
        @endif
    </div>
@endif
