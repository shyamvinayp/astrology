@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>

@section('title', 'Dashboard | Lara Admin')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop
{{--

@section('content')
  <div class="row">
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $userCount }}</h3>
          <p>Customers</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="{{URL::to('/')}}/customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-info">
          <div class="inner">
              <h3>{{ $scamCount }}</h3>
              <p>Scammers</p>
          </div>
          <div class="icon">
              <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{URL::to('/')}}/scams" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
      <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-warning">
              <div class="inner">
                  <h3>{{ $scamTypeCount }}</h3>
                  <p>Scam Types</p>
              </div>
              <div class="icon">
                  <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{URL::to('/')}}/scamtypes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
  </div>

    <!-- sencond row-->
  <div class="row">
      <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-warning">
              <div class="inner">
                  <h3>{{ $carrierCount }}</h3>
                  <p>Carriers</p>
              </div>
              <div class="icon">
                  <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{URL::to('/')}}/carriers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
              <div class="inner">
                  <h3>{{ $scamcenterCount }}</h3>
                  <p>Scam Center</p>
              </div>
              <div class="icon">
                  <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{URL::to('/')}}/scamcenters" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
              <div class="inner">
                  <h3>{{ $agencycontactCount }}</h3>
                  <p>Agency Contact</p>
              </div>
              <div class="icon">
                  <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{URL::to('/')}}/agencycontact" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
  </div>
@endsection
--}}
