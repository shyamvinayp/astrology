<a href="{!! $href or '#' !!}" id="{{ $id  }}" style="border:1px solid grey" data-toggle="modal" data-target="#modal-default" class="btn btn-link btn-float text-size-small has-text legitRipple {!! $extraCls  or ''!!}" {!! $anchorExtra or '' !!}>
    @if(isset($badgeCount))
        <span class="badge badge-flat {!! $badgeCls or '' !!}">{!! $badgeCount !!}</span>
    @endif
    <i class="fa fa-plus text-primary"></i>
    <span>{!! $text !!}</span>
</a>
