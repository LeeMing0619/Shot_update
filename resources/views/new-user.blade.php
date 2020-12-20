@extends('layouts.app')
@section('title', 'SeempleShot Hire and Discover')
@section('css')
<style media="screen">
.btn-pro {
  color: #fff;
  background-color: #91afb6;
  border-color: #91afb6;
}
.btn-client {
    color: #fff;
    background-color: #8980a5;
    border-color: #8980a5;
}
</style>
@endsection
@section('content')
  <div class="container my-4">
    <div class="row">
      <div class="col-md-6" style="text-align: center; padding: 15px; margin: 0 0 20px 0; line-height: 1.9em;">
        <img src="{{ asset('images/signup-professional.png') }}" alt="register as a visual artist" width="200">
        <div class="bg-white" style="padding: 35px; border-radius: 3px; height: 27em;">
          <h3 style="margin: 0 0 20px 0; font-size: 25px;">Are you a talented and artistic photographer or videographer?</h3>
          <p style="font-size: 16px;">
            SeempleShot offers a platform where you can showcase your work to the public at no cost. Seempleshot is dedicated to giving our professionals the liberty to work for themselves and choose the jobs that best suit them, therefore we will be bringing the clients to you. We do not expect you to pay any fees in order to register on our platform, it is free of charge. 
          </p>
          <a href="{{ route('pro-register') }}" class="btn btn-success btn-lg" style=" margin-top: 40px;">I am a visual artist</a>
        </div>
      </div>
      <div class="col-md-6" style="text-align: center; padding: 15px; margin: 0 0 20px 0; line-height: 1.9em;">
        <img src="{{ asset('images/signup-client.png') }}" alt="register as a visual artist" width="200">
        <div class=" bg-white" style="padding: 35px; border-radius: 3px; height: 27em;">
          <h3 style="margin: 0 0 20px 0; font-size: 25px;">Are you planning an event and want to book a talented visuall artist?</h3>
          <p style="font-size: 16px;">
          Seempleshot is a web service that allows for the client to discover and hire talented visual artists. As the client, this platform gives you an opportunity to discover skillful professionals in your area who are passionate and very dedicated to their craft. Your memories are priceless, so we want to ensure that the person that you choose to collaborate with isn’t just another photographer or videographer, but is an artist first.
          </p>
          <a href="{{ route('client-register') }}" class="btn btn-secondary btn-lg">I am a client</a>
        </div>
      </div>
    </div>
  </div>
@endsection
