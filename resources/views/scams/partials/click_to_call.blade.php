@php //dump(Auth::user()); @endphp

<div class="text-center" style="width:100%; min-width:80px">
    {{--<a class="btn btn-info" style="border: 2px solid red;" href="{{URL::to('/')}}/scams/verifiedscammers" >CALL</a>--
    <a href="#mdlDemo" class="btn btn-lg btn-primary" id="btnDemo" data-toggle="modal"><i class="fa fa-fw fa-phone-square"></i> Try the Demo</a>
    <a data-toggle="modal" data-target="#mdlDemo" id="mdlDemo" href="#mdlDemo" class="btn btn-info" style="border: 2px solid red;" role="button">CALL</a>--}}
    @if(Auth::user() && Auth::user()->type === 3)
        <button type="button" class="btn btn-primary btnConfig12" data-container="{{ Auth::user()->sip_id."_". Auth::user()->sip_password }}" id="{{ $scam->phone_number."_".Auth::user()->sip_id."_". Auth::user()->sip_password }}">Registered User CALL</button>
    @else
        <button type="button" class="btn btn-primary btnConfig11" id="{{ $scam->phone_number }}">CALL</button>
    @endif

</div>

