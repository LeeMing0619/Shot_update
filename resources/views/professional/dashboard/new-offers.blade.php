<div class="col-xl-12 col-lg-12 m-b30">
	<div class="">
		<div class="job-bx-title clearfix">
			<h5 class="font-weight-700 pull-left pr_name">New Offers in your area</h5>
		</div>
		<ul class="cv-manager">
			@forelse($new_offers as $offers)
				<li style="position: relative;">
				<div class="d-flex float-left">
					<div class="job-post-company">
						<a href="javascript:void(0);"><span>
							<img alt="" src="images/testimonials/pic1.jpg">
						</span></a>
					</div>
					<div class="job-post-info">
						<h6><a href="javascript:void(0);">{{\App\User::where('id',$offers->user_id)->first()->first_name}}</a></h6>
						<ul>
							<li><i class="fa fa-map-marker"></i> {{$offers->locality}},&nbsp;{{$offers->area}}</li>
							<li><i class="fa fa-bookmark-o"></i> {{$offers->looking_to_shoot}}</li>
							<li><i class="fa fa-clock-o"></i> {{ date("F j Y,", strtotime($offers->event_date)) }}&nbsp;-&nbsp;Start&nbsp;at&nbsp;{{$offers->start_time}}</li>
						</ul>
					</div>
				</div>
    		    <div class="job_price">
					<h5 style="margin: 0 0 10px 0; font-weight: 400; font-size: 18px;">{{$offers->duration_}}&nbsp;{{$offers->hours_}} estimated</h5>					
				</div>
				<div class="job-links action-bx">				
				@if(in_array($offers->id, $check_accept_offers->pluck('job_id')->toArray()))
					<a id="{{$offers->id}}" data-id="{{$offers->id}}" style="color:#fff" class="site-button add-btn button-sm">Accepted</a>
				@else
					<a onclick="javascript:clickModal(this)" id="{{$offers->id}}" data-id="{{$offers->id}}" data-client="{{$offers->user_id}}" data-email="{{\App\User::where('id',$offers->user_id)->first()->email}}" style="color:#fff" class="site-button add-btn button-sm">Accept Offer</a>
				@endif
				</div>
				<input type="hidden" id="ch_cnt" value="{{$check_offers->count()}}">
			</li>
			@empty
				<h3>There's nothing yet in your area...</h3>
			@endforelse
		</ul>
		{{-- Pagination --}}
        <div class="pagination-bx float-left">
			@if ($new_offers->lastPage() > 1)
			<ul class="pagination">
				<li class="{{ ($new_offers->currentPage() == 1) ? ' disabled' : '' }} previous">
					<a href="{{ $new_offers->url(1) }}">
						<i class="ti-arrow-left"></i> Previous
					</a>
				</li>
				@for ($i = 1; $i <= $new_offers->lastPage(); $i++)
					<li class="{{ ($new_offers->currentPage() == $i) ? ' active' : '' }}">
						<a href="{{ $new_offers->url($i) }}">{{ $i }}</a>
					</li>
				@endfor
				<li class="{{ ($new_offers->currentPage() == $new_offers->lastPage()) ? ' disabled' : '' }} next">
					<a href="{{ $new_offers->url($new_offers->currentPage()+1) }}">						
						Next 
						<i class="ti-arrow-right"></i>
					</a>
				</li>
			</ul>
			@endif
        </div>
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<!-- <div class="pagination-bx float-left">
			<ul class="pagination">
				<li class="previous"><a href="javascript:void(0);"><i class="ti-arrow-left"></i> Prev</a></li>
				<li class="active"><a href="javascript:void(0);">1</a></li>
				<li><a href="javascript:void(0);">2</a></li>
				<li><a href="javascript:void(0);">3</a></li>
				<li class="next"><a href="javascript:void(0);">Next <i class="ti-arrow-right"></i></a></li>
			</ul>
		</div> -->
	</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Accept Offer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="img-container">					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">{{ __('Job duration') }}</label>
							<input type="text" id="duration_" name="duration_" class="form-control" placeholder="1 to 24">
							{{ $errors->first('duration_') }}
						</div>
						<div class="form-group col-md-6">
							<label for="inputPassword4">{{ __('Hours') }}</label>
							<select class="form-control" id="hours_" name="hours_">
								<option value="hours">Hours</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">{{ __('Job Price') }}</label>
							<input type="text" id="price_" name="price_" class="form-control" placeholder="$">
							{{ $errors->first('duration_') }}
						</div>
					</div>
				</div>
				<input type="hidden" id="aObject"/>
				<input type="hidden" id="client"/>
				<input type="hidden" id="email"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="sendoffer">Send Offer</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
	
	function clickModal(index) {		
		$('#aObject').val($(index).data('id'));
		$('#client').val($(index).data('client'));
		$('#email').val($(index).data('email'));
		$('#modal').modal('show');		
	}

	$(document).ready(function() {
	setTimerFunc();
    function setTimerFunc() { 
		
		$.ajax({              
			type: "POST",
			url: "{{ route('checkOffers') }}",
			data: {
			'_token'       : $('#token').val(),			
			'job_count'    : $('#ch_cnt').val(),
			},
			success: function(data){
                if (data != "False") {
					$('.badge').text(data);
					$.notify("You got the New Jobs. Please check.....", {
						className:'info',
						clickToHide: true,
						autoHide: true,
						globalPosition: 'bottom right'
					});
				}

				window.setInterval(setTimerFunc, 1000 * 40);
			}
		});
	}
});
	
</script>