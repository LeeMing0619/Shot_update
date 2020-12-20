<div class="col-xl-12 col-lg-12 m-b30">
	<div class="">
		<div class="job-bx-title clearfix">
			<h5 class="font-weight-700 pull-left pr_name">my jobs</h5>
		</div>
		<ul class="cv-manager">
		@forelse($hired_jobs as $hired_job)
			@forelse($check_offers as $offers)			
				@if ($hired_job->job_id == $offers->id)
			<li style="position: relative;">
				<div class="d-flex float-left">
					<div class="job-post-company">
						<a href="javascript:void(0);"><span>
							<img alt="" src="images/testimonials/pic1.jpg">
						</span></a>
					</div>
					<div class="job-post-info">
						<h6><a href="javascript:void(0);" class="pr_name">{{\App\User::where('id',$offers->user_id)->first()->first_name}} {{\App\User::where('id',$offers->user_id)->first()->last_name}}</a></h6>
						<ul>
							<li><i class="fa fa-map-marker"></i> {{$offers->area}},&nbsp;{{$offers->event_address}}</li>
							<li><i class="fa fa-bookmark-o"></i> {{$offers->looking_to_shoot}}</li>
							<li><i class="fa fa-clock-o"></i> {{ date("F j Y,", strtotime($offers->event_date)) }}&nbsp;-&nbsp;Start&nbsp;at&nbsp;{{$offers->start_time}} ({{$offers->duration_}}hrs)</li>
						</ul>
					</div>
				</div>
        		<div class="job_price">
					<h5 style="font-weight: 400; font-size: 14px;">
						<a href="javascript:void(0)" class="pr_name" onclick="javascript:viewDetails('{{\App\User::where('id',$offers->user_id)->first()->first_name}}', '{{\App\User::where('id',$offers->user_id)->first()->last_name}}', '123123', '{{$offers->area}} {{$offers->event_address}}')" data-toggle="modal" data-target="#jobDetails"><i class="fa fa-info-circle" aria-hidden="true"></i> view job details</a></h5>
				</div>
				<div class="job-links action-bx">
					<a href="javascript:void(0)" id="{{ $hired_job->job_id }}" onclick="javascript:clickJobComplete({{ $hired_job->job_id }})" class="site-button add-btn button-sm">Job Completed</a>
				</div>
			</li>
				@endif
			@empty
				
			@endforelse			
			@empty
				<h3>There's nothing yet in your area...</h3>
		@endforelse
		</ul>
		{{-- Pagination --}}
        <div class="pagination-bx float-left">
			@if ($hired_jobs->lastPage() > 1)
			<ul class="pagination">
				<li class="{{ ($hired_jobs->currentPage() == 1) ? ' disabled' : '' }} previous">
					<a href="/dashboard?tab=my_jobs&page=1">
						<i class="ti-arrow-left"></i> Previous
					</a>
				</li>
				@for ($i = 1; $i <= $hired_jobs->lastPage(); $i++)
					<li class="{{ ($hired_jobs->currentPage() == $i) ? ' active' : '' }}">
						<a href="/dashboard?tab=my_jobs&page={{ $i }}">{{ $i }}</a>
					</li>
				@endfor
				<li class="{{ ($hired_jobs->currentPage() == $hired_jobs->lastPage()) ? ' disabled' : '' }} next">
					<a href="/dashboard?tab=my_jobs&page={{ $hired_jobs->currentPage()+1 }}">						
						Next 
						<i class="ti-arrow-right"></i>
					</a>
				</li>
			</ul>
			@endif
        </div>
	</div>
</div>

<div class="modal fade modal-bx-info editor" id="jobDetails" tabindex="-1" role="dialog" aria-labelledby="ResumeheadlineModalLongTitle" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-top: 175.3px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ResumeheadlineModalLongTitle">Resume Headline</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
      <div class="modal-body">
        <h3 style="padding: 0 0 15px 0; font-size: 18px; background-color: #222; color: #fff; padding: 7px 10px; border-radius: 3px; font-weight:400;" class="pr_name">client contact info</h3>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">{{ __('First Name') }}</label>
            <input type="text" id="first_name" name="first_name" style="border: none; background-color: rgba(0,0,0,0.01);" class="form-control pr_name" value="gerard" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">{{ __('Last Name') }}</label>
            <input type="text" id="last_name"  style="border: none; background-color: rgba(0,0,0,0.01);" name="last_name" class="form-control pr_name" value="kasemba" disabled>
          </div>
        </div>
          <div class="form-group col-md-12" style="padding: 0;">
            <label for="inputPassword4">{{ __('Phone Number') }}</label>
            <input type="text" id="phone_number"  style="border: none; background-color: rgba(0,0,0,0.01);" name="last_name" class="form-control pr_name" value="(978) 918 0688" disabled>
          </div>
        <h3 style="padding: 0 0 15px 0; font-size: 18px; background-color: #222; color: #fff; padding: 7px 10px; border-radius: 3px; font-weight:400;">Event Address</h3>
        <h6 class="pr_name" id="event_address" style="font-weight: 400; font-size: 16px; margin: 10px 0 0 0;"><i class="fa fa-map-marker" aria-hidden="true"></i> 3 walton st, dorchester, ma, 02124</h6>
        <h6 class="pr_name" style="font-weight: 400; font-size: 16px; margin: 10px 0 0 0;"><i class="fa fa-question-circle" aria-hidden="true"></i> The place is located in a museum next to the David's statue</h6>
      </div>
			<div class="modal-footer">
				<button type="button" class="site-button" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function viewDetails(first_name, last_name, phone_number, address) 
{
	$('#first_name').val(first_name);
	$('#last_name').val(last_name);
	$('#phone_number').val(phone_number);
	$('#event_address').html('<i class="fa fa-map-marker" aria-hidden="true"></i> ' + address);
}

function clickJobComplete(jobID) 
{
	$.ajax({
		
		type: "POST",
		//dataType: "json",
		url: "{{ route('send_complete') }}",
		data: { '_token': $('meta[name="_token"]').attr('content'),'job_id': jobID },
		success: function(data){ 		
			$('#'+jobID).text('Complted');
			$('#'+jobID).removeAttr('onclick');
			alert("success job complete");
		},
		error: function(data){ alert('false');
			console.log(data);
		}
	});	
}
</script>
