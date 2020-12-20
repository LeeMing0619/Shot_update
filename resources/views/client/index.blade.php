@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('css')
<style media="screen">
  .job_price{position: absolute; top: 0; right: 30px; padding: 0 0 15px 0;}
  .pac-container {z-index: 1051 !important;}
  .wickedpicker {z-index: 1051 !important;}
</style>
@endsection
@section('content')
<div class="page-content">
  <div class="container">
    @if(Auth::user()->account_type == "client")
      <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 m-b30">
        <div class="candidate-info onepage">
          <a href="{{ route('new-booking.index') }}" class="site-button button" style="margin: 0 0 15px 0;">New Booking</a>
          <div class="sticky-top bg-white job-bx" style="padding: 0; z-index: 100;">
            <h3 style="padding: 20px 10px 10px 20px; font-size: 20px;">Quick Categories</h3>
            <ul>
              @foreach($main_categories as $categories)
                <li><a href="/home?catid={{$categories->id}}" class=""><i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{$categories->category}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12" style="overflow: hidden;">      
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/home' || strlen(URL::full()) < 36) active @endif" href="/home"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;My Jobs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/home?tab=open_contract' || Str::contains(URL::full(), 'tab=open_contract')) active @endif" href="/home?tab=open_contract"><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;Open Contracts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/home?tab=closed_contract' || Str::contains(URL::full(), 'tab=closed_contract')) active @endif" href="/home?tab=closed_contract"><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;Closed  Contracts</a>
          </li>
        </ul>
        <div class="" style="padding: 25px 0 0 0;">
          @if(URL::full() == "http://127.0.0.1:8000/home" || strlen(URL::full()) < 36)
            @include('client.dashboard.my-jobs')
          @elseif(URL::full() == "http://127.0.0.1:8000/home?tab=pending_pro" || Str::contains(URL::full(), 'tab=pending_pro'))
            @include('client.dashboard.pending-pro')
          @elseif(URL::full() == "http://127.0.0.1:8000/home?tab=open_contract" || Str::contains(URL::full(), 'tab=open_contract'))
            @include('client.dashboard.open-contracts')
          @elseif(URL::full() == "http://127.0.0.1:8000/home?tab=closed_contract" || Str::contains(URL::full(), 'tab=closed_contract'))
            @include('client.dashboard.closed-contract')
          @endif
        </div>
      </div>
    </div>
    @else
      <h1>404 Page Not Found</h1>
    @endif
  </div>
</div>
<!-- Our Latest Blog -->
@endsection