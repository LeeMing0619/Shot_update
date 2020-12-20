<div class="clearfix">
  <div class="job-bx-title clearfix">
    <h5 class="font-weight-700 pull-left pr_name">My Professionals</h5>
  </div>
	<ul class="cv-manager">
		@forelse($openJobs as $openJob)
		<li>
			<div class="d-flex float-left">
				<div class="job-post-company">
					<a href="javascript:void(0);"><span>
					@if(\App\NewPhoto::where([['user_id',$openJob->pro_id], ['category', 'Professisonal']])->first())
						<img alt="" src="photos/{{\App\NewPhoto::where([['user_id',$openJob->pro_id], ['category', 'Professisonal']])->first()->picture}}">
					@else
						<img alt="" src="images/testimonials/pic1.jpg">
					@endif
					</span></a>
				</div>
				<div class="job-post-info">
					<h6>
						<a href="javascript:void(0);">{{\App\User::where('id',$openJob->pro_id)->first()->first_name}} {{\App\User::where('id',$openJob->pro_id)->first()->last_name}}</a>
						<p>ratings</p>
					</h6>
					<ul>
						<li><i class="fa fa-map-marker"></i> {{\App\User::where('id',$openJob->pro_id)->first()->area}},&nbsp;{{\App\User::where('id',$openJob->pro_id)->first()->business_adress}}</li>
						<li><i class="fa fa-filter"></i> {{\App\User::where('id',$openJob->pro_id)->first()->pro_type}}</li>
					</ul>
				</div>
			</div>
			<div class="job-links action-bx">
				<a style="font-weight: 600; color: #333; margin: 0 5px 0 0;">${{$openJob->job_price}} for {{$openJob->job_hours}}hrs</a>
			</div>
		</li>
		@empty
			<h3>There's nothing yet in your area...</h3>
		@endforelse
	</ul>
	{{-- Pagination --}}
	<div class="pagination-bx float-left">
		@if ($openJobs->lastPage() > 1)
		<ul class="pagination">
			<li class="{{ ($openJobs->currentPage() == 1) ? ' disabled' : '' }} previous">
				<a href="/home?tab=open_contract&page=1">
					<i class="ti-arrow-left"></i> Previous
				</a>
			</li>
			@for ($i = 1; $i <= $openJobs->lastPage(); $i++)
				<li class="{{ ($openJobs->currentPage() == $i) ? ' active' : '' }}">
					<a href="/home?tab=open_contract&page={{ $i }}">{{ $i }}</a>
				</li>
			@endfor
			<li class="{{ ($openJobs->currentPage() == $openJobs->lastPage()) ? ' disabled' : '' }} next">
				<a href="/home?tab=open_contract&page={{ $openJobs->currentPage()+1 }}">						
					Next 
					<i class="ti-arrow-right"></i>
				</a>
			</li>
		</ul>
		@endif
	</div>
</div>
