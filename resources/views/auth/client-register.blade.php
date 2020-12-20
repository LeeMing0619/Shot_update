@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="cards">
                <div class="">
                  <h3>{{ __('Create your free Account:') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">First Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') border border-danger @enderror" value="{{ old('first_name') }}">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Last Name</label>
                            <input type="text" name="last_name" class="form-control  @error('last_name') border border-danger @enderror"  value="{{ old('last_name') }}">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="password">{{ __('Account Type:') }}</label>
                            <select class="form-control " id="account_type_selcted" name="account_type">
                                <option value="client">Client</option>
                            </select>
                        </div>
                        <!-- PROFESSIONAL FORM  -->

                          <div id="professional" class="">
                            <div class="form-group">
                              <input type="hidden" name="pro_type" value="none">
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="phone_number" value="none">
                            </div>
                            <div class="col-lg-12 col-md-12" style="padding: 0;">
                              <input type="hidden" name="receive_text" value="none">
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="moto" value="none">
                            </div>
                            <div class="form-group">
                              <div class="panel panel-primary form-group">
                                <input type="hidden" name="business_adress" value="none">
                                <input type="hidden" name="street_number" value="none">
                                <input type="hidden" name="route" value="none">
                                <input type="hidden" name="locality" value="none">
                                <input type="hidden" name="area" value="none">
                                <input type="hidden" name="postal_code" value="none">
                                <input type="hidden" name="country" value="none">
                              </div>
                            </div>

                          </div>

                        <!-- END PROFESSIONAL FORM  -->
                        <div class="form-group" style="text-align: right;">
                          <button type="submit" class="site-button button outline outline-2">{{ __('Create account now') }}</button>
                              <!-- <button type="submit" class="site-button">
                                  {{ __('Create account now') }}
                              </button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.15/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript">
$(function() {

    $('#phone_number').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });
});
</script>
@endsection
