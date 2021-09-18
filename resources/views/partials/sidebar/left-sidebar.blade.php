<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
	@if(Auth::user())
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu">
				<!--<li class="nav-item">

					<a class="nav-link  " href="http://localhost/project/sipnected_new/public/home">

					<i class="nav-icon fas fa-tachometer-alt"></i>

					<p>Home</p></a>

				</li>-->
				<li class="nav-item">

					<a class="nav-link  " href="{{URL::to('/')}}/dashboard">

					<i class="nav-icon fas fa-tachometer-alt"></i>

					<p>Dashboard</p></a>

				</li>
               
				<li class="nav-item">

					<a class="nav-link  " href="{{URL::to('/')}}/users">

					<i class="fas fa-fw fa-user "></i>

					<p>Users</p></a>

				</li>
            </ul>
        </nav>
    </div>
	@endif

</aside>
