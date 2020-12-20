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
      <div class="sticky-top bg-white job-bx" style="padding: 0;">
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
      <form action="{{ route('schedule.create') }}" method="post">
      @csrf
      @method("GET")
      <div class="form-group">
        <h3>Payment method</h3>
        <p>We want you to know that SeempleShot will not charge you anything for being in our website. We want you to express your art and keep your money because you desrve it! You don;t have to share it with us, we want to bring clients to you by letting them know how you woul like to get paid! And all jobs are 100% guaranteed!</p>
        <div class="form-group">
            <label><input type="checkbox" name="payment_method[]" value="Cash"> Cash</label>
            <label><input type="checkbox" name="payment_method[]" value="Check"> Checks</label>
            <label><input type="checkbox" name="payment_method[]" value="CashApp"> Cash App</label>
            <label><input type="checkbox" name="payment_method[]" value="Debit/Credit Card"> Debit/Credit Card</label>
            <label><input type="checkbox" name="payment_method[]" value="Money Order"> Money Order</label>
        </div>
        </div>
        <div class="form-group">
          <h3>Do you ask for deposit</h3>
          <label><input type="radio" name="deposit" value="Yes"> Yes</label>
          <label><input type="radio" name="deposit" value="No"> No</label>
        </div>
        <div class="form-group">
          <h3>Refundable</h3>
          <label><input type="radio" name="refundable" value="no"> Not refundable</label>
          <label><input type="radio" name="refundable" value="yes"> Refundable</label>
        </div>
        <div class="form-group">
          <h3>Days available to work</h3>
          <div class="form-group">

              <label><input type="checkbox" name="days[]" value="Monday"> Monday</label>
              <label><input type="checkbox" name="days[]" value="Tuesday"> Tuesday</label>
              <label><input type="checkbox" name="days[]" value="Wednsday"> Wednsday</label>
              <label><input type="checkbox" name="days[]" value="Thursday"> Thursday</label>
              <label><input type="checkbox" name="days[]" value="Friday"> Friday</label>
              <label><input type="checkbox" name="days[]" value="Saturday"> Saturday</label>
              <label><input type="checkbox" name="days[]" value="Sunday"> Sunday</label>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" name="button" class="site-button">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function() {

});
</script>
@endsection
