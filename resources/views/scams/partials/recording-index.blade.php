<div style="text-align:center;"> {{ strtoupper($scam->recording_verification) }} <div>
@if(isset($scam->verification_audio))
    <audio controls>
        <source src="{{ url('public/upload/verifications/'.$scam->verification_audio) }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@endif
