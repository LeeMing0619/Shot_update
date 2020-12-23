<div class="clearfix">
  <div class="job-bx-title clearfix">
    <h5 class="font-weight-700 pull-left pr_name">My Closed contracts</h5>
  </div>
	<ul class="cv-manager">
	@forelse($closedJobs as $closeJob)
		<li>
			<div class="d-flex float-left">
				<div class="job-post-company">
					<a href="javascript:void(0);"><span>				
					@if(\App\NewPhoto::where([['user_id',$closeJob->pro_id], ['category', 'Professisonal']])->first())
						<img alt="" src="photos/{{\App\NewPhoto::where([['user_id',$closeJob->pro_id], ['category', 'Professisonal']])->first()->picture}}">
					@else
						<img alt="" src="images/testimonials/pic1.jpg">
					@endif
					</span></a>
				</div>
				<div class="job-post-info">
					<h6>
						<a href="javascript:void(0);">{{\App\User::where('id',$closeJob->pro_id)->first()->first_name}} {{\App\User::where('id',$closeJob->pro_id)->first()->last_name}}</a>
						@if(\App\Feedback::where('job_id',$closeJob->job_id)->first())
						<p>@for($i=0; $i<5; $i++)
							@if ($i < floor((\App\Feedback::where('job_id',$closeJob->job_id)->first()->skills + \App\Feedback::where('job_id',$closeJob->job_id)->first()->quality) / 2))
								<i class="fa fa-star"></i> 
							@elseif ($i < round((\App\Feedback::where('job_id',$closeJob->job_id)->first()->skills + \App\Feedback::where('job_id',$closeJob->job_id)->first()->quality) / 2))
								<i class="fa fa-star-half-o"></i> 
							@else
								<i class="fa fa-star-o"></i>
								@endif
							@endfor  
						{{(\App\Feedback::where('job_id',$closeJob->job_id)->first()->skills + \App\Feedback::where('job_id',$closeJob->job_id)->first()->quality) / 2 }}
						
						@endif
					</h6>
					<ul>
						<li><i class="fa fa-map-marker"></i> {{\App\User::where('id',$closeJob->pro_id)->first()->area}},&nbsp;{{\App\User::where('id',$closeJob->pro_id)->first()->business_adress}}</li>
						<li><i class="fa fa-filter"></i> {{\App\User::where('id',$closeJob->pro_id)->first()->pro_type}}</li>
					</ul>
				</div>
			</div>
			@if(\App\Feedback::where('job_id',$closeJob->job_id)->first())
				<div class="job-links action-bx">			
					<a style="font-weight: 600; color: #333; margin: 0 5px 0 0;">Job Completed</a>
				</div>
			@else
				<div class="job-links action-bx">
					<a href="/feedback/{{$closeJob->job_id}}" class="site-button add-btn button-sm">Leave Feedback</a>
				</div>
			@endif			
		</li>
		@empty
			<h3>There's nothing yet in your area...</h3>
		@endforelse
	</ul>
	{{-- Pagination --}}
	<div class="pagination-bx float-left">
		@if ($closedJobs->lastPage() > 1)
		<ul class="pagination">
			<li class="{{ ($closedJobs->currentPage() == 1) ? ' disabled' : '' }} previous">
				<a href="/home?tab=closed_contract&page=1">
					<i class="ti-arrow-left"></i> Previous
				</a>
			</li>
			@for ($i = 1; $i <= $closedJobs->lastPage(); $i++)
				<li class="{{ ($closedJobs->currentPage() == $i) ? ' active' : '' }}">
					<a href="/home?tab=closed_contract&page={{ $i }}">{{ $i }}</a>
				</li>
			@endfor
			<li class="{{ ($closedJobs->currentPage() == $closedJobs->lastPage()) ? ' disabled' : '' }} next">
				<a href="/home?tab=closed_contract&page={{ $closedJobs->currentPage()+1 }}">						
					Next 
					<i class="ti-arrow-right"></i>
				</a>
			</li>
		</ul>
		@endif
	</div>
</div>
