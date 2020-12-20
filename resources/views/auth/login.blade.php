@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="" style="margin: 20px 0 0 0;">
                <div class=""><h3>Welcome Back!</h3></div>

                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                          <label for="inputAddress">Email</label>
                          <input type="email" name="email" class="form-control  @error('email') border border-danger @enderror"  value="{{ old('email') }}">
                          @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                          <label for="inputAddress">Password</label>
                          <input type="password" name="password" class="form-control  @error('password') border border-danger @enderror" id="email">
                          @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0" style="clear: both; text-align: right;">
                            <div class="col-md-8 offset-md-4">
                              @if (Route::has('password.request'))
                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                      {{ __('Forgot Your Password?') }}
                                  </a>
                              @endif
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login Now') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
