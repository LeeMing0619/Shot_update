@extends('layouts.app')
@section('css')
<style media="screen">
#personal_information,
#company_information{
  display:none;
}
.has-error .form-control {
    border-color: #ff7675;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
.help-block {
    color: #ff7675;
}
</style>
@endsection
@section('content')
<div class="container">
  <div class="page-content">
    <div class="row">
    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 m-b30">
      <div class="sticky-top bg-white job-bx" style="padding: 0; z-index: 10">
        @include("professional.includes.settings-nav")
      </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12" style="overflow: hidden;">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px 0 0 0;">
        <p style="margin: 0; padding: 0;">{{session('success')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <form method="POST" action="{{ route('settings.edit', $user['id']) }}" id="myform">
        @csrf
        @method("GET")
          <h3 style="padding:0 0 25px 0;">Account information</h3>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">{{ __('First Name') }}</label>
              <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $user['first_name'] }}">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">{{ __('Last Name') }}</label>
              <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $user['last_name'] }}">
            </div>
          </div>
          <div class="form-group">
              <label for="email">{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ $user['email'] }}" name="email" required autocomplete="email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          @if(Auth::user()->account_type == "professional")
          <h3 style="padding:15px 0 25px 0;">Business Info</h3>
          <div class="form-group">
            <label for="password">{{ __('You are:') }} {{ $user['pro_type'] }}</label>
              <select class="form-control " id="pro_type" name="pro_type">
                  <option value="photographer">Photographer</option>
                  <option value="videographer">Videographer</option>
                  <option value="both">Can do both</option>
              </select>
          </div>
          <div class="form-group">
              <label for="email">{{ __('Phone Number') }}</label>
              <div class="col-md-6" style="padding: 0;">
                <input id="phone_number" type="text" class="form-control" name="phone_number" autocomplete="off" placeholder="(xxx) xxx - xxxx" value="{{ $user['phone_number'] }}">
              </div>
          </div>
          <div class="col-lg-12 col-md-12" style="padding: 0;">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="enable_text" name="receive_text" @if($user['receive_text'] == 'yes') checked @endif value="yes">
              <label class="custom-control-label" for="enable_text">Enable text
                Massages(optional)</label>
            </div>
          </div>
          <div class="form-group">
            <p class="notify-txt">By checking the box, you electronically authorize
              SeempleShot to send you automated text messages to notify you of
              customer activity an about our services.</p>
          </div>
          <div class="form-group">
            <label for="business_moto">Why should people hire you?</label>
            <textarea class="form-control" spellcheck="false" id="moto" name="moto">{{ $user['moto'] }}</textarea>
          </div>
          <div class="form-group">
            <div class="panel panel-primary form-group">
              <label class="control-label" for="autocomplete">Business address</label>
              <div class="panel-body">
                <input id="autocomplete" value="{{ $user['business_adress'] }}" placeholder="Enter your address" onfocus="geolocate()" type="text" class="form-control pac-target-input" autocomplete="off" name="business_adress">
                <input class="form-control" id="street_number" disabled="true" type="hidden" name="street_number" value="{{ $user['street_number'] }}">
                <input class="form-control" id="route" disabled="true" type="hidden" name="route" value="{{ $user['route'] }}">
                <input class="form-control field" id="locality" disabled="true" type="hidden" name="locality" value="{{ $user['locality'] }}">
                <input class="form-control" id="administrative_area_level_1" disabled="true" type="hidden" name="area" value="{{ $user['area'] }}">
                <input class="form-control" id="postal_code" disabled="true" type="hidden" name="postal_code" value="{{ $user['postal_code'] }}">
                <input class="form-control" id="country" disabled="true" type="hidden" name="country" value="{{ $user['country'] }}">
              </div>
            </div>
          </div>
        @endif
          <button type="submit" class="site-button button">{{ __('Update Account') }}</button>
      </form>
    </div>
  </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.15/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript" src="{{ asset('js/form-validation.js') }}"></script>
<script type="text/javascript">
$(function() {

    $('#phone_number').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });
    $('.alert').alert()
});
</script>
@endsection
