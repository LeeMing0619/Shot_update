
<div class="col-xl-12 col-lg-12 m-b30">
	<div class="">
		<div class="job-bx-title clearfix">
			<h5 class="font-weight-700 pull-left pr_name">open bookings</h5>
		</div>
    	<table class="table-job-bx cv-manager company-manage-job">
			<tbody>			
			@foreach($myJobs as $myJob)
				<tr>
					<td class="job-name">
						<a href="javascript:void(0);">{{ $myJob->looking_to_shoot }}</a>
						<ul class="job-post-info">
							<li><i class="fa fa-map-marker"></i> {{ $myJob->event_address }}</li>
							<li><i class="fa fa-calendar"></i> {{ date("F j Y,", strtotime($myJob->created_at)) }}</li>
							<li><i class="fa fa-clock-o"></i>  Start at {{ $myJob->start_time }} for ({{$myJob->duration_}}hrs)</li>
						</ul>
					</td>
					<td class="application text-primary"><a href="/home?tab=pending_pro&jobId={{$myJob->id}}" style="padding: 0; margin: 0;"><i class="fa fa-hourglass-end" aria-hidden="true"></i> ({{$total_accepted->where('job_id', $myJob->id)->count()}}) Applications</a></td>
					<td class="job-links">
						<a href="javascript:void(0);" onclick="javascript:edit_booking({{$myJob->id}})">
						<i class="fa fa-pencil"></i></a>
						<a href="" onclick="javascript:del_booking({{$myJob->id}})"><i class="ti-trash"></i></a>
					</td>
				</tr>
			@endforeach				
			</tbody>
		</table>
		{{-- Pagination --}}
        <div class="pagination-bx float-left">
			@if ($myJobs->lastPage() > 1)
			<ul class="pagination">
				<li class="{{ ($myJobs->currentPage() == 1) ? ' disabled' : '' }} previous">
					<a href="{{ $myJobs->url(1) }}">
						<i class="ti-arrow-left"></i> Previous
					</a>
				</li>
				@for ($i = 1; $i <= $myJobs->lastPage(); $i++)
					<li class="{{ ($myJobs->currentPage() == $i) ? ' active' : '' }}">
						<a href="{{ $myJobs->url($i) }}">{{ $i }}</a>
					</li>
				@endfor
				<li class="{{ ($myJobs->currentPage() == $myJobs->lastPage()) ? ' disabled' : '' }} next">
					<a href="{{ $myJobs->url($myJobs->currentPage()+1) }}">						
						Next 
						<i class="ti-arrow-right"></i>
					</a>
				</li>
			</ul>
			@endif
        </div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Tell us what you neeed</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="overflow: hidden;">					
					<form class="form-horizontal" method="POST" id="newBookingForm" style="padding: 20px 0 0 0;" action="{{ route('changeBooking')}}">
					@csrf
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="user_id">
					<input type="hidden" name="booking_index" id="booking_index">
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
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label>Can your professional showcase the finished work in their SimpleShot portfolio?</label>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="custom-control custom-radio">
										<input type="radio" class="" name="allow_employee" checked value="yes">
										<label class="custom-control-label" for="employ_yes">Yes, they can showcase the finished work!</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="custom-control custom-radio">
										<input type="radio" class="" name="allow_employee" value="no">
										<label class="custom-control-label" for="employ_no">No, don't even try!</label>
									</div>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="site-button button" name="button">Send Request</button>
				</form>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script>
<script type="text/javascript" src="{{ asset('js/new-booking-min.js')}}"></script>
<script src="{{ asset('js/autocompleteaddress.js')}}"></script>
<script type="text/javascript">

$(function() {
  $('[data-toggle="datepicker"]').datepicker({
    autoHide: true,
    zIndex: 2048,
  });
});

function del_booking(job_id) 
{
	$.ajax({            
		type: "POST",
		//dataType: "json",
		url: "{{ route('deleteBooking') }}",
		data: {'_token': $('meta[name="_token"]').attr('content'), 'job_id': job_id},
		success: function(data){
			$.notify("success delete the portofolio", "success");
		},
		error: function(data){
			console.log(data);
		}
	});

	return false;
}

function edit_booking(job_id) 
{
	$.ajax({            
		type: "POST",
		url: "{{ route('editBooking') }}",
		data: {'_token': $('meta[name="_token"]').attr('content'), 'job_id': job_id},
		success: function(data){ console.log(data);
			$("#looking_to_shoot").val("Party");
			$("#address_details").val(data.address_details);
			$("#duration_").val(data.duration_);
			$("#event_date").val(data.event_date);
			$("#start_time").val(data.start_time);
			$("#booking_index").val(job_id);
			$("#editModal").modal("show");
		},
		error: function(data){
			console.log(data);
		}
	});

	return false;
} 
</script>
@endsection