@extends('layouts.app')
@section('css')
<style media="screen">
/* .job_header {height: 40vh; background-color: #fff;} */
label {color: #636e72;}
</style>
@endsection
@section('content')
<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 m-b30">
        <div class="sticky-top" style="padding: 0; z-index: 10">
          <h1>Left</h1>
        </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12" style="overflow: hidden;">
        <h3 style="font-size: 40px;">Tell us what you neeed</h3>
        <form class="form-horizontal" method="POST" id="newBookingForm" style="padding: 20px 0 0 0;" action="{{ route('new-booking.create')}}">
          @csrf
          @method("GET")
          <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="user_id">
          <div class="form-group">
            <label for="password">{{ __('I am looking to book:') }}</label>
              <select class="form-control " id="pro_type" name="pro_type">
                  <option value="photographer">Photographer</option>
                  <option value="videographer">Videographer</option>
                  <option value="both">Can do both</option>
              </select>
          </div>
          <div class="form-group">
            <label for="password">{{ __('What do you need to shoot:') }}</label>
              <select class="form-control " id="looking_to_shoot" name="looking_to_shoot">
                @foreach($main_categories as $categories)
                  <option value="{{$categories->category}}">{{$categories->category}}</option>
                @endforeach
              </select>
          </div>
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
          <div class="col-lg-12 col-md-12" style="clear: both; text-align: right;">
            <button type="submit" class="site-button button" name="button">Send Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
