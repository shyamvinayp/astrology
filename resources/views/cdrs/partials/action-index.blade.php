@php $id = 10; @endphp

@if(Auth::user())
    @if(Auth::user()->type === 1)
        <div class="text-center" style="width:100%; min-width:80px">
            <a href="{{URL::to('/')}}/callerids/{{ $callerid->id }}/edit"   class="btn btn-xs btn-info" style="padding: 8px 13px;"><i class="fa fa-edit"></i></a>
            <form method="POST" action="{{URL::to('/')}}/callerids/{{ $callerid->id }}" accept-charset="UTF-8" style="display:inline;">
                <input name="_method" value="DELETE" type="hidden"><input name="_token" value="{{ csrf_token() }}" type="hidden">
                <button class="btn btn-xs btn-danger user-del-btn" style="padding: 8px 13px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>
        </div>
    @elseif(Auth::user()->type === 3)
        <div class="text-center" style="width:100%; min-width:80px">
            <a href="{{URL::to('/')}}/callerids/{{ $callerid->id }}/view" class="btn btn-xs btn-info" style="padding: 8px 13px;"><i class="fa fa-eye"></i></a>
        </div>
    @endif

@endif
