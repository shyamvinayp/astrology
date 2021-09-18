{{--@php
    $breadcrumbsView = get_module_breadcrumb_view();

@endphp
@if ($breadcrumbsView)
    @include($breadcrumbsView)
@endif--
@include('partials.breadcrumbs')--}}

@if (count($breadcrumbs))

   {{-- <ol class="breadcrumb">--}}
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
   {{-- </ol>--}}

@endif
