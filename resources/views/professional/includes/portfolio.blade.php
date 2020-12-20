<div class="tab-pane fade active show" id="v-pills-portfolio" role="tabpanel" aria-labelledby="v-pills-portfolio-tab" style="display: block;">
	<div id="" class="job-bx table-job-bx" style="box-shadow: none;">
		<div class="">
			<div class="containers">
				<div class="site-filters style1 clearfix center">
					<ul class="filters" data-toggle="buttons">
						<li data-filter="" class="btn active"><input type="radio"><a href="#"><span>All</span></a></li>
						<li data-filter="pet" class="btn"><input type="radio"><a href="#"><span class="pr_name">Pet</span></a></li>
					</ul>
				</div>
				<div class="clearfix">
					<ul id="masonry_portofolio" class="list-unstyled row dez-gallery-listing gallery-grid-4 gallery mfp-gallery sp10">
						@forelse($gallery as $galleries)
							@foreach (json_decode($galleries->picture) as $pic)
						<li class="card-container col-lg-4 col-md-3 col-sm-6 col-6 cards_ {{$galleries->category}}" data-responsive="http://127.0.0.1:8000/storage/photos/{{$pic}} 375, http://127.0.0.1:8000/storage/photos/{{$pic}} 480, http://127.0.0.1:8000/storage/photos/{{$pic}} 800" data-src="http://127.0.0.1:8000/storage/photos/{{$pic}}" data-sub-html="">
							<div class="dez-media dez-img-overlay1 dez-img-effect">
								<a href="">									
									<img class="img-responsive" src="http://127.0.0.1:8000/storage/photos/{{$pic}}">									
								</a>
							</div>
							
							<img onclick="javascript:portfolioDelete(this, {{$galleries->id}})" src="http://127.0.0.1:8000/storage/close.png" style="position: absolute; top: 4px; right: 5px;width:50px; z-index:10;">
							
						</li>
							@endforeach
						@empty

						@endforelse
					</ul>					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function portfolioDelete(index, id) {
	$(index).parent().remove();
	$.ajax({            
		type: "POST",
		//dataType: "json",
		url: "{{ route('portfolioDelete') }}",
		data: {'_token': $('meta[name="_token"]').attr('content'), 'id': id},
		success: function(data){
			$(index).parent().remove();
			$.notify("success delete the portofolio", "success");
		},
		error: function(data){
			console.log(data);
		}
	});

	return false;
}
</script>