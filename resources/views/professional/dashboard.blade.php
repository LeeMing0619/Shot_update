
@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('css')
<style media="screen">
  .job_price{position: absolute; top: 0; right: 30px; padding: 0 0 15px 0;}
  .badge { position: relative; top: -10px; right: -3px; background-color: #37a000; color: #fff;border-radius: 50%; } 
</style>
@endsection
@section('content')
<div class="page-content">
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/dashboard' || strlen(URL::full()) < 42) active @endif" href="/dashboard"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;New Offers <span class="badge badge-light newoffers"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/dashboard?tab=pending_offers' || Str::contains(URL::full(), 'tab=pending_offers')) active @endif" href="/dashboard?tab=pending_offers"><i class="fa fa-hourglass-end" aria-hidden="true"></i>&nbsp;Pending Jobs <span class="badge badge-light pending"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/dashboard?tab=my_jobs' || Str::contains(URL::full(), 'tab=my_jobs')) active @endif" href="/dashboard?tab=my_jobs"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp;My Jobs <span class="badge badge-light myjob"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/dashboard?tab=past_jobs' || Str::contains(URL::full(), 'tab=past_jobs')) active @endif" href="/dashboard?tab=past_jobs"><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;Past Jobs</a>
      </li>
    </ul>
    <input type="hidden" id="ch_cnt" value="{{ $check_offers->count() }}">
    <input type="hidden" id="my_job_cnt" value="{{ $hired_jobs_count->count() }}">
    <div class="" style="padding: 25px 0 0 0;">
      @if(URL::full() == "http://127.0.0.1:8000/dashboard" || strlen(URL::full()) < 42)
        @include('professional.dashboard.new-offers', [
        'new_offers' => $new_offers,
        ])
      @elseif(URL::full() == "http://127.0.0.1:8000/dashboard?tab=pending_offers" || Str::contains(URL::full(), 'tab=pending_offers'))
        @include('professional.dashboard.pending-offers')
      @elseif(URL::full() == "http://127.0.0.1:8000/dashboard?tab=my_jobs" || Str::contains(URL::full(), "tab=my_jobs"))
        @include('professional.dashboard.my-jobs')
      @elseif(URL::full() == "http://127.0.0.1:8000/dashboard?tab=past_jobs" || Str::contains(URL::full(), 'tab=past_jobs'))
        @include('professional.dashboard.past-jobs')
      @endif
    </div>
  </div>
</div>
<!-- Our Latest Blog -->
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    window.setInterval(setTimerFunc, 1000 * 10);
    console.log('start____________');
    
		function setTimerFunc() { 
			
			$.ajax({              
				type: "POST",
				url: "{{ route('checkOffers') }}",
				data: {
				'_token'       : $('#token').val(),			
        'job_count'    : $('#ch_cnt').val(),
        'hired_count'  : $('#my_job_cnt').val(),
				},
				success: function(data){
					if (data.status != false) {
            if (data.message == 1) {
              $('.newoffers').text(data.new_count);
              $.notify("You got the New Jobs. Please check.....", {
                className:'info',
                clickToHide: true,
                autoHide: true,
                globalPosition: 'bottom right'
              });

              $('#ch_cnt').val(eval($('#ch_cnt').val()) + eval(data.new_count));
            } else {
              $('.myjob').text(data.new_count);
              $.notify("You just hired, Please check.....", {
                className:'info',
                clickToHide: true,
                autoHide: true,
                globalPosition: 'bottom right'
              });

              $('#my_job_cnt').val(eval($('#my_job_cnt').val()) + eval(data.new_count));
            }
            console.log('Receive-----');
					}
				}
      });
		}
  });
</script>
@endsection
