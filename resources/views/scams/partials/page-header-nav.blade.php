@php $prefix = 'tbl_user_' ;
@endphp
<style>
    .rcorners2 {
        border-radius: 10px;
        border: 2px solid lightgrey;
        margin-right: 2px;
    }
</style>
<div class="card-header p-2">
    <ul class="nav nav-pills">

        @foreach($numbers_tabs as $key => $tab)
            <li class="nav-item rcorners2"><a class="nav-link page-header-tab" href="#{{$tab}}" data-toggle="tab">{{$tab}}</a></li>
        @endforeach

        {{--<li class="nav-item"><a class="nav-link" href="#account-info" data-toggle="tab">Account Info</a></li>
        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Billing</a></li>
        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Security</a></li>--}}
    </ul>
</div>
