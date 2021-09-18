<div class="form-group ">
    @if(!isset($skipCancel) || !$skipCancel)
        <a href="{!! (url()->previous() === url()->current())?'/':url()->previous() !!}" class="btn btn-info">{!! $cancelValue !!}</a>
    @endif
    <button type="submit" class="btn btn-{!! $submitBtnStatus!!}">
        {!! $submitValue !!}
    </button>

</div>
