@if($customer->status == 1)
<a onclick="return confirm('Are you sure you want to activate {{ $customer->_name }}?')" href="{{route('customers.changeStatus', $customer->id)}}"   class="edit btn btn-primary btn-sm">Activate</a>
@else
<a onclick="return confirm('Are you sure you want to deactivate {{ $customer->name }}?')" href="{{route('customers.changeStatus', $customer->id)}}"   class="edit btn btn-secondary btn-sm">Deactive</a>
@endif

