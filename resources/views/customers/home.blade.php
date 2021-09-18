@extends('adminlte::page')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Customer Home Page') }}</div>

                <div class="card-body">

                    <div class="alert alert-success" role="alert">
                        {{ "Account Status: Active" }}
                    </div>

                   {{--@if (Auth::User())
                       @if(Auth::User()->status === 2)
                        <div class="alert alert-warning" role="alert">
                            {{ "Account Status: Pending" }}
                        </div>
                        @else
                            <div class="alert alert-success" role="alert">
                                {{ "Account Status: Active" }}
                            </div>
                        @endif
                    @endif--}}

                    {{ __('You are registred successfully! Please login using email and password') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
