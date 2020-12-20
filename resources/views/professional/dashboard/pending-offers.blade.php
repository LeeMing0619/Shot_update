<div class="col-xl-12 col-lg-12 m-b30">
	<div class="">
		<div class="job-bx-title clearfix">
			<h5 class="font-weight-700 pull-left pr_name">accepted offers</h5>
		</div>
		<ul class="cv-manager">
		@forelse($accept_offers as $accept)
			@forelse($check_offers as $offers)			
				@if ($accept->job_id == $offers->id)
			<li style="position: relative;">
				<div class="d-flex float-left">
					<div class="job-post-company">
						<a href="javascript:void(0);"><span>
							<img alt="" src="images/testimonials/pic1.jpg">
						</span></a>
					</div>
					<div class="job-post-info">
						<h6><a href="javascript:void(0);">{{\App\User::where('id',$offers->user_id)->first()->first_name}} {{\App\User::where('id',$offers->user_id)->first()->last_name}}</a></h6>
						<ul>
							<li><i class="fa fa-map-marker"></i> {{$offers->area}},&nbsp;{{$offers->event_address}}</li>
							<li><i class="fa fa-bookmark-o"></i> {{$offers->looking_to_shoot}}</li>
							<li><i class="fa fa-clock-o"></i> {{ date("F j Y,", strtotime($offers->event_date)) }}&nbsp;-&nbsp;Start&nbsp;at&nbsp;{{$offers->start_time}}</li>
						</ul>
					</div>
				</div>
        		<div class="job_price">
					<h5>Pending...</h5>
				</div>
				<div class="job-links action-bx">
					<a id="{{$offers->id}}" data-id="{{$offers->id}}" style="color:#fff" onclick="javascript:clickDel(this, {{$accept->id}})" class="btn btn-warning add-btn button-sm" style="padding: 3px 10px; color: #fff;">Cancel Offer</a>
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
			@if ($accept_offers->lastPage() > 1)
			<ul class="pagination">
				<li class="{{ ($accept_offers->currentPage() == 1) ? ' disabled' : '' }} previous">
					<a href="/dashboard?tab=pending_offers&page=1">
						<i class="ti-arrow-left"></i> Previous
					</a>
				</li>
				@for ($i = 1; $i <= $accept_offers->lastPage(); $i++)
					<li class="{{ ($accept_offers->currentPage() == $i) ? ' active' : '' }}">
						<a href="/dashboard?tab=pending_offers&page={{ $i }}">{{ $i }}</a>
					</li>
				@endfor
				<li class="{{ ($accept_offers->currentPage() == $accept_offers->lastPage()) ? ' disabled' : '' }} next">
					<a href="/dashboard?tab=pending_offers&page={{ $accept_offers->currentPage()+1 }}">						
						Next 
						<i class="ti-arrow-right"></i>
					</a>
				</li>
			</ul>
			@endif
        </div>
	</div>
</div>

<script type="text/javascript">
	function clickDel(index, id) {
		$.ajax({
            
			type: "POST",
			//dataType: "json",
			url: "{{ route('sendofferdel') }}",
			data: {'_token': $('meta[name="_token"]').attr('content'), 'accepted_id': id},
			success: function(data){
				$(index).parent().parent().remove();
				alert("success send offer");
			},
			error: function(data){
				console.log(data);
			}
		});
	}		
</script>