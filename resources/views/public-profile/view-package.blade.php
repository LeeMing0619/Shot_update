
@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('css')
<style media="screen">
.package_header {height: auto; background-color: #fff; padding: 20px 0;}
.package_nam {font-size: 20px; font-weight: 600;}
.package_media {max-width: 300px; height: 250px; background-color:rgba(189, 195, 199,1.0); border-radius: 3px; margin: 0 15px 0 0; position: relative;}
.package_price{position: absolute; top: 0; right:0; background: red; padding: 5px 15px; background: rgba(47, 54, 64,0.5); color: #fff; font-weight: 600;}
</style>
@endsection
@section('content')
<div class="package_header">
  <div class="container">
    @forelse($packages as $package)
    <div class="form-row list_pck">
      <div class="form-group col-md-3">
        <div class="package_media">

        </div>
      </div>
      <div class="form-group col-md-9 pr_name" style="position: relative;">
        <h1>{{ $package->category }}</h1>
        <p>By <a href="home/">{{\App\User::where('id', $package->user_id)->first()->first_name}}</a></p>
        <div class="form-row list_pck">
          <div class="form-group col-md-4">
            <h3 style="color: #555; font-weight: 600;">{{$package->currency}}{{$package->price}}/hr</h3>
            <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#requestService"  class="btn btn-dark" style="padding: 15px 20px; font-size: 17px; margin: 10px 0 0 0;">Request Service</a> -->
          </div>
        </div>
      </div>
    </div>
    @empty
      <h1>404 Page doesn't exist</h1>
    @endforelse
  </div>
</div>
<div class="page-content">
  <div class="container">
    <div class="form-row list_pck">
      <div class="form-group col-md-5">
        <h3 style="color: #555; font-weight: 700;">What you will get:</h3>
      </div>
      <div class="form-group col-md-7" style="position: relative;">
        <h3 style="color: #555; font-size: 20px; line-height: 1.9em; font-weight: 400;">{!! html_entity_decode($package->details) !!}</h3>
      </div>
      <div class="form-group col-md-5">
        <h3 style="color: #555; font-weight: 700;">What clients say about this artist:</h3>
      </div>
      <div class="form-group col-md-7" style="position: relative;">
        @foreach($feedbacks as $feedback)
          <p>{{ $feedback->description }} </p>
        @endforeach
      </div>
      <div class="form-group col-md-5">
        <h3 style="color: #555; font-weight: 700;">Other services by {{\App\User::where('id', $package->user_id)->first()->first_name}}</h3>
      </div>
      <div class="form-group col-md-7" style="position: relative;">
        @php
          $package_related = \App\ProPackage::where('user_id', $package->user_id)->where('id', '!=', $package->id)->latest()->paginate(10)
        @endphp
        @foreach($package_related as $more_packages)
          <div class="form-row list_pck">
            <div class="form-group col-md-3">
              <div class="package_media" style="width: 150px; height: 150px;">

                <span class="package_price">
                  {{$more_packages->currency}}{{$more_packages->price}}/hr
                </span>
              </div>
            </div>
            <div class="form-group col-md-9" style="position: relative;">
              <p class="mb-1 package_nam">{!! html_entity_decode($more_packages->category) !!}</p>
              <p class="mb-1">{!! html_entity_decode($more_packages->equipment) !!}</p>
              <p class="mb-1">{!! html_entity_decode($more_packages->lenses) !!}</p>
            </div>
          </div>
        @endforeach
        {{ $package_related->links() }}
      </div>
    </div>
  </div>
</div>
<!-- Our Latest Blog -->
<!-- Modal -->
<div class="modal fade modal-bx-info editor" id="requestService" tabindex="-1" role="dialog" aria-labelledby="ProfilesummaryModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ProfilesummaryModalLongTitle">Request Service - {{$package->category}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="POST" id="newBookingForm" style="padding: 20px 0 0 0;" action="{{ route('new-booking.create')}}">
          @csrf
          @method("GET")
          <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="user_id">
          <div class="form-group">
            <div class="panel panel-primary form-group">
              <label class="control-label" for="autocomplete">Location</label>
              <div class="panel-body">
                <input id="autocomplete" placeholder="Enter your address" onfocus="geolocate()" type="text" class="form-control pac-target-input" autocomplete="off" name="event_address">
                <input class="form-control" id="street_number" disabled="true" type="hidden" name="street_number">
                <input class="form-control" id="route" disabled="true" type="hidden" name="route">
                <input class="form-control field" id="locality" disabled="true" type="hidden" name="locality">
                <input class="form-control" id="administrative_area_level_1" disabled="true" type="hidden" name="area">
                <input class="form-control" id="postal_code" disabled="true" type="hidden" name="postal_code">
                <input class="form-control" id="country" disabled="true" type="hidden" name="country">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="business_moto">Location details, e.g. floor number, where to meet:</label>
            <textarea class="form-control" spellcheck="false" id="address_details" rows="5" name="address_details"></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4">{{ __('Job duration') }}</label>
              <input type="text" id="duration_" name="duration_" class="form-control" placeholder="1 to 24">
              {{ $errors->first('duration_') }}
            </div>
            <div class="form-group col-md-3">
              <label for="inputPassword4">{{ __('Hours') }}</label>
              <select class="form-control" id="hours_" name="hours_">
                <option value="hours">Hours</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6" style="padding: 0;">
            <label for="inputPassword4">{{ __('Choose a date') }}</label>
            <input type="text" name="event_date" id="event_date" class="form-control"  data-toggle="datepicker" autocomplete="off">
            {{ $errors->first('event_date') }}
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">{{ __('Start time') }}</label>
              <input type="text" id="start_time" name="start_time" class="form-control timepicker-12-hr">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">{{ __('Time Zone') }}</label>
              <select class="form-control" name="time_zone" id="time_zone">
                <option value="CST">Central Standard Time</option>
                <option value="EST">Eastern Standard Time</option>
                <option value="MST-Danver">Mountain Standard Time (Danver)</option>
                <option value="MST-Phoenix">Mountain Standard Time (Phoenix)</option>
                <option value="PST">Pacific Standard Time</option>
                <option value="AST">Alaska Standard Time</option>
                <option value="HAST">Hawaii-Aleutian Standard Time</option>
              </select>
            </div>
          </div>
          <div class="col-lg-12 col-md-12" style="
                padding: 0;
            ">
            <div class="form-group">
              <label>Can your professional showcase the finished work in their SimpleShot portfolio?</label>
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="employ_yes" name="allow_employee" value="yes">
                          <label class="custom-control-label" for="employ_yes">Yes, they can showcase the finished work!</label>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="employ_no" name="allow_employee" value="no">
                          <label class="custom-control-label" for="employ_no">No, don't even try!</label>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="site-button" data-dismiss="modal">Cancel</button>
        <button type="button" class="site-button">Send Offer</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script>
<script type="text/javascript" src="{{ asset('js/new-booking-min.js')}}"></script>
<script type="text/javascript">
$(function() {
  $('[data-toggle="datepicker"]').datepicker({
    autoHide: true,
    zIndex: 2048,
    format: 'yyyy-mm-dd',
  });
});
</script>
@endsection