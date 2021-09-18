@if($announcement->rcgrp_status == 1)
<a onclick="return confirm('Are you sure you want to activate {{ $announcement->rcgrp_name }}?')" href="{{route('announcements.changeStatus', $announcement->id)}}"   class="edit btn btn-primary btn-sm">Activate</a>
@else
<a onclick="return confirm('Are you sure you want to deactivate {{ $announcement->rcgrp_name }}?')" href="{{route('announcements.changeStatus', $announcement->id)}}"   class="edit btn btn-secondary btn-sm">Deactive</a>
@endif

