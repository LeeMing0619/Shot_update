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
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="cards">
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}" id="myform">
              @csrf
              <fieldset id="account_information" class="">
                <legend>Account information</legend>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">{{ __('First Name') }}</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">{{ __('Last Name') }}</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}">
                  </div>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">{{ __('Account Type:') }}</label>
                    <select class="form-control " id="account_type" name="account_type">
                        <option value="professional">Professional</option>
                    </select>
                </div>
                <p><a class="btn site-button next" style="color: #fff;">Next Step</a></p>
              </fieldset>

              <fieldset id="company_information" class="">
                <legend>Business Info</legend>
                <div class="form-group">
                  <label for="password">{{ __('I am a:') }}</label>
                    <select class="form-control " id="pro_type" name="pro_type">
                        <option value="photographer">Photographer</option>
                        <option value="videographer">Videographer</option>
                        <option value="both">Can do both</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Phone Number') }}</label>
                    <div class="col-md-6" style="padding: 0;">
                      <input id="phone_number" type="text" class="form-control" name="phone_number" autocomplete="off" placeholder="(xxx) xxx - xxxx" value="{{ old('phone_number') }}">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" style="padding: 0;">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="enable_text" name="receive_text" checked>
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
                  <textarea class="form-control" spellcheck="false" id="moto" name="moto">{{ old('moto') }}</textarea>
                </div>
                <div class="form-group">
                  <div class="panel panel-primary form-group">
                    <label class="control-label" for="autocomplete">Business address</label>
                    <div class="panel-body">
                      <input id="autocomplete" placeholder="Enter your address" onfocus="geolocate()" type="text" class="form-control pac-target-input" autocomplete="off" name="business_adress">
                      <input class="form-control" id="street_number" disabled="true" type="hidden" name="street_number">
                      <input class="form-control" id="route" disabled="true" type="hidden" name="route">
                      <input class="form-control field" id="locality" disabled="true" type="hidden" name="locality">
                      <input class="form-control" id="administrative_area_level_1" disabled="true" type="hidden" name="area">
                      <input class="form-control" id="postal_code" disabled="true" type="hidden" name="postal_code">
                      <input class="form-control" id="country" disabled="true" type="hidden" name="country">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <p><a class="btn btn-outline-secondary" id="previous">Previous</a></p>
                  </div>
                  <div class="form-group col-md-1">
                    <p><button type="submit" class="btn site-button">{{ __('Create account now') }}</button></p>
                  </div>
                </div>
              </fieldset>

            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.15/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript" src="{{ asset('js/form-validation.js') }}"></script>
<script type="text/javascript">
$(function() {

    $('#phone_number').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });
});
</script>
@endsection
