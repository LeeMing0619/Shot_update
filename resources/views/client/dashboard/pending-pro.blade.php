<div class="" style="padding: 0 0 25px 0; font-weight: 400;">
@foreach($selectedJOB as $sj)
  <h1 style="font-size: 25px;">{{$sj->looking_to_shoot}}</h1>
  <a style="font-weight: 600; color: #333; margin: 0 5px 0 0;"><i class="fa fa-calendar"></i> Event date - {{ date("F j Y,", strtotime($sj->created_at)) }}</a>
  <a style="font-weight: 600; color: #333; margin: 0 5px 0 0;"><i class="fa fa-clock-o"></i> Event time - starts at {{$sj->start_time}}</a>
  <div class="">
    <a style="font-weight: 600; color: #333; margin: 0 5px 0 0;" class="pr_name"><i class="fa fa-map"></i> 3 walton st, dorchester, ma, 01902</a>
  </div>
  <div class="">
    <a style="font-weight: 600; color: #333; margin: 0 5px 0 0;" class="pr_name"><i class="fa fa-info"></i> The house has a red door in front of it.</a>
  </div>
@endforeach
</div>

<div class="clearfix">
	<ul class="cv-manager">
  @foreach($acceptedJOBS as $acceptedJOB)
		<li>
			<div class="d-flex float-left">
				<div class="job-post-company">
					<a href="javascript:void(0);"><span>
          @if(\App\NewPhoto::where([['user_id',$acceptedJOB->pro_id], ['category', 'Professisonal']])->first())
						<img alt="" src="photos/{{\App\NewPhoto::where([['user_id',$acceptedJOB->pro_id], ['category', 'Professisonal']])->first()->picture}}">
					@else
						<img alt="" src="images/testimonials/pic1.jpg">
					@endif
					</span></a>
				</div>
				<div class="job-post-info">
					<h6><a href="javascript:void(0);">{{\App\User::where('id',$acceptedJOB->pro_id)->first()->first_name}} {{\App\User::where('id',$acceptedJOB->pro_id)->first()->last_name}}</a></h6>
					<ul>
						<li><i class="fa fa-map-marker"></i> {{\App\User::where('id',$acceptedJOB->pro_id)->first()->area}},&nbsp;{{\App\User::where('id',$acceptedJOB->pro_id)->first()->business_adress}}</li>
						<li><i class="fa fa-filter"></i> {{\App\User::where('id',$acceptedJOB->pro_id)->first()->pro_type}}</li>
					</ul>
				</div>
			</div>
			<div class="job-links action-bx">
				<a style="font-weight: 600; color: #333; margin: 0 5px 0 0;">${{$acceptedJOB->job_price}} for {{$acceptedJOB->job_hours}}hrs</a>
				<a href="javascript:void(0)" onclick="javascript:clickModal(this)" class="site-button add-btn button-sm" data-id="{{$acceptedJOB->job_id}}" data-price="{{$acceptedJOB->job_price}}" data-pro="{{$acceptedJOB->pro_id}}" data-proemail="{{$acceptedJOB->pro_email}}" data-client="{{$acceptedJOB->client_id}}" data-clientemail="{{$acceptedJOB->client_email}}">Book Now</a>   
			</div>
		</li>
  @endforeach
	</ul>	
</div>

<div class="modal fade modal-bx-info editor" id="bookNow" tabindex="-1" role="dialog" aria-labelledby="ResumeheadlineModalLongTitle" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-top: 175.3px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ResumeheadlineModalLongTitle">Resume Headline</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
      <div class="modal-body">
        <h3 style="padding: 0 0 15px 0; font-size: 18px; background-color: #222; color: #fff; padding: 7px 10px; border-radius: 3px; font-weight:400;" class="pr_name">Contact Info</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">{{ __('First Name') }}</label>
            <input type="text" id="first_name" name="first_name" style="" class="form-control pr_name" value="{{ Auth::user()->first_name }}">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">{{ __('Last Name') }}</label>
            <input type="text" id="last_name"  style="" name="last_name" class="form-control pr_name" value="{{ Auth::user()->last_name }}">
          </div>
        </div>
          <div class="form-group col-md-12" style="padding: 0;">
            <label for="inputPassword4">{{ __('Phone Number') }}</label>
            <input type="text" id="phone_number"  style="" name="Phone_number" class="form-control" autocomplete="off" placeholder="(XXX) XXX - XXXX">
          </div>
        <h3 style="padding: 0 0 15px 0; font-size: 18px; background-color: #222; color: #fff; padding: 7px 10px; border-radius: 3px; font-weight:400;">Event Address</h3>
        <h6 class="pr_name" style="font-weight: 400; font-size: 16px; margin: 10px 0 0 0;"><i class="fa fa-map-marker" aria-hidden="true"></i> 3 walton st, dorchester, ma, 02124</h6>
        <h6 class="pr_name" style="font-weight: 400; font-size: 16px; margin: 10px 0 0 0;"><i class="fa fa-question-circle" aria-hidden="true"></i> The place is located in a museum next to the David's statue</h6>
        <h3 style="padding: 0 0 15px 0; font-size: 18px; background-color: #222; color: #fff; padding: 7px 10px; border-radius: 3px; font-weight:400; margin: 15px 0;" class="pr_name">Booking Fee</h3>
				<p>You need to pay a booking fee of $7 to complete the process.</p>
        <div class="form-group">
            <label>Are you done booking for this job?</label>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="employ_yes" value="1" checked name="employ">
                        <label class="custom-control-label" for="employ_yes">Yes</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="employ_no"  value="0" name="employ">
                        <label class="custom-control-label" for="employ_no">No</label>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <input type="hidden" id="pro_id"/>
      <input type="hidden" id="pro_email"/>
      <input type="hidden" id="job_id"/>
      <input type="hidden" id="client_id"/>
      <input type="hidden" id="client_email"/>
			<div class="modal-footer">
				<button type="button" class="site-button" id="bookings">Book</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade modal-bx-info editor" id="stripe" tabindex="-1" role="dialog" aria-labelledby="ResumeheadlineModalLongTitle" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-top: 175.3px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ResumeheadlineModalLongTitle">Payment Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
			<form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
				<div class='form-row row'>
					<div class='col-xs-12 col-md-4 form-group required'>
						<label class='control-label'>Name on Card</label> 
						<input class='form-control' size='4' type='text' value="Lee">
					</div>
				
					<div class='col-xs-12 col-md-8 form-group cvc required'>
						<label class='control-label'>Card Number</label> 
						<input autocomplete='off' class='form-control card-num' size='20' type='text' value="4242 4242 4242 4242">
					</div>
				</div>

				<div class='form-row row'>
					<div class='col-xs-12 col-md-4 form-group cvc required'>
						<label class='control-label'>CVC</label> 
						<input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4' type='text' value="4242">
					</div>
					<div class='col-xs-12 col-md-4 form-group expiration required'>
						<label class='control-label'>Expiration Month</label> 
						<input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' value="11">
					</div>
					<div class='col-xs-12 col-md-4 form-group expiration required'>
						<label class='control-label'>Expiration Year</label> 
						<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' value="2021">
					</div>
				</div>
			</div>
      <input type="hidden" id="price_value" name="price_value">
			<div class="modal-footer">
				<button type="submit" class="site-button" id="booking_pay">Pay Now</button>
			</div>
			</form>
		</div>
	</div>
</div>


@section('scripts')
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.15/dist/jquery-input-mask-phone-number.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('js/form-validation.js') }}"></script>

<script type="text/javascript">
function clickModal(index) {
  $('#pro_id').val($(index).data('pro'));
  $('#pro_email').val($(index).data('proemail'));
  $('#job_id').val($(index).data('id'));
  $('#client_id').val($(index).data('client'));
  $('#client_email').val($(index).data('clientemail'));
  $('#price_value').val($(index).data('price'));
  $('#bookNow').modal('show');		
}
$(function() {

    $('#phone_number').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });

    $('#bookings').click(function(){
      
      if ($('#employ_no').is(":checked") == true) {
        $('#bookNow').modal('hide');
        return false;
      }
      
      $.ajax({
              
        type: "POST",
        url: "{{ route('bookings') }}",
        data: {
          '_token'       : $('meta[name="_token"]').attr('content'),
          'pro_id'       : $('#pro_id').val(),
          'pro_email'    : $('#pro_email').val(),
          'job_id'       : $('#job_id').val(),
          'client_id'    : $('#client_id').val(),
          'client_email' : $('#client_email').val(),
          'hire_status'  : $('#employ_yes').is(":checked") == true ? 1 : 0,
          },
        success: function(data){
            $('#bookNow').modal('hide');
            $('#stripe').modal('show');
            $('#booking_pay').text('Pay Now $'+$('#price_value').val());
        },
        error: function(data){
            console.log(data);
        }
      });
    });

    ///Stripe payment
    var $form = $(".validation");
  	$('form.validation').bind('submit', function(e) {
    	var $form = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus  = $form.find('div.error'),
        valid         = true;
        
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }
  
  });
  
  var num_pending_client = 0;

  function stripeHandleResponse(status, response) { 
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else { 
            $.notify("Payment success!", {
                    className:'success',
                    clickToHide: true,
                    autoHide: true,
                    globalPosition: 'top right'
                });
            num_pending_client++;
            $('.opencontracts').text(num_pending_client);
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});
</script>
@endsection
