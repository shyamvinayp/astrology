{{--@if($customer->tbl_connection_status == 1)
<a onclick="return confirm('Are you sure you want to activate {{ $customer->tbl_sip_connection_name }}?')" href="{{route('connections.changeStatus', $customer->id)}}" alt="{{ $customer->id }}" id="change-status"  class="edit btn btn-primary btn-sm">Activate</a>
@else
<a onclick="return confirm('Are you sure you want to deactivate {{ $customer->tbl_sip_connection_name }}?')" href="{{route('connections.changeStatus', $customer->id)}}" alt="{{ $customer->id }}" id="change-status"  class="edit btn btn-secondary btn-sm">Deactive</a>
@endif
--}}
{{--
data-confirm = 'Are you sure you want to chagne status?'--}}

@if($customer->tbl_connection_status == 1)
    <a href="javascript:void(0);" onclick="changeStatus({{ $customer->id }})" alt="{{ $customer->id }}" id="change-status"  class="connection-status edit btn btn-primary btn-sm">Activate</a>

@else
    <a href="javascript:void(0);" onclick="changeStatus({{ $customer->id }})" alt="{{ $customer->id }}" class="connection-status edit btn btn-secondary btn-sm">Deactive</a>
@endif

{{--
data-confirm = 'Are you sure you want to chagne status?'--}}

