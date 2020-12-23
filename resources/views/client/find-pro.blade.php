
@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('css')
<style media="screen">
.package_nam {font-size: 20px; font-weight: 600;}
.list_pck {border-bottom: 1px solid #dcdde1; padding: 15px 5px;}
.list_pck:hover {background-color: #f4f4f4;}
.package_media {width: 128px; height: 128px; background-color:rgba(189, 195, 199,1.0); border-radius: 3px; margin: 0 15px 0 0; position: relative;}
.package_price{position: absolute; top: 0; right:0; background: red; padding: 5px 15px; background: rgba(47, 54, 64,0.5); color: #fff; font-weight: 600;}

</style>
@endsection
@section('content')

<!-- Section Banner -->
<div class="profile-edit p-t50 p-b20" style="background-color: #fff;">
  <div class="container">
    <div class="row">
		<div class="col-lg-8 col-md-7 candidate-info">
			<div class="candidate-detail">
        <div class="row">
          <div class="col-md-4">
            <div class="canditate-des text-center">
              <a href="javascript:void(0);">
                @if($profile)
                  <img alt="" id="profile_preview_container" src="../photos/{{$profile}}">
                @else
                  <img alt="" id="profile_preview_container" src="images/team/pic1.jpg">
                @endif
              </a>
              <form action="javascript:void(0)" method="POST">
                @csrf
                <div class="upload-link" title="" data-toggle="tooltip" data-placement="right" data-original-title="update">
                  <input type="file" name="profile_image" id="profile_image" class="update-flie">
                  <i class="fa fa-camera"></i>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-8">
            <div class="text-left" style="color: #222;">
              <h2 class="m-b0 pr_name" style="color: #222;">{{ \App\User::where('id', $user_id)->first()->first_name }} {{ \App\User::where('id', $user_id)->first()->last_name }}
                <a class="m-l15 font-16 text-white" data-toggle="modal" data-target="#profilename" href="#"><i class="fa fa-pencil"></i></a>
              </h2>
              @if(\App\Feedback::where('pro_id',$user_id)->first())
                <p>@for($i=0; $i<5; $i++)
                    @if ($i < floor((\App\Feedback::where('pro_id',$user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$user_id)->count()))
                      <i class="fa fa-star"></i> 
                    @elseif ($i < round((\App\Feedback::where('pro_id',$user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$user_id)->count()))
                      <i class="fa fa-star-half-o"></i> 
                    @else
                      <i class="fa fa-star-o"></i>
                    @endif
                   @endfor  
                   {{(\App\Feedback::where('pro_id',$user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$user_id)->count() }}
                </p>

              @endif
              <p class="m-b15" style="color: #222;margin: 15px 0;">
                {{ \App\User::where('id', $user_id)->first()->moto }}
              </p>
              <ul class="clearfix">
                <li style="float: left;"><i class="ti-location-pin float-left"></i> {{ \App\User::where('id', $user_id)->first()->area }}, {{ \App\User::where('id', $user_id)->first()->business_adress }}</li>
                <li><i class="ti-camera float-left"></i> <span class="pr_name">{{ \App\User::where('id', $user_id)->first()->pro_type }}</span></li>
              </ul>
              <div class="job-time mr-auto">

              </div>
            </div>
          </div>
        </div>
			</div>
    </div>    
	</div>
</div>
</div>
<div class="page-content">
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link @if(strlen(URL::full()) < 38) active @endif" href="/pro-profile/{{ $user_id }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Portfolio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(Str::contains(URL::full(), 'tab=reviews')) active @endif" href="/pro-profile/{{ $user_id }}?tab=reviews"><i class="fa fa-comments" aria-hidden="true"></i> Review</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(Str::contains(URL::full(), 'tab=services')) active @endif" href="/pro-profile/{{ $user_id }}?tab=services"><i class="fa fa-id-card-o" aria-hidden="true"></i> Services</a>
      </li>
    </ul>
    
    <div class="" style="padding: 25px 0 0 0;">
      @if(strlen(URL::full()) < 38)
        @include('professional.includes.portfolio', [
        'gallery' => $pro_gallery
        ])
      @elseif(Str::contains(URL::full(), "tab=reviews"))
        @include('professional.includes.reviews')
      @elseif(Str::contains(URL::full(), "tab=services"))
        @include('professional.includes.dashboard', [
        'packages' => $packages
        ])
      @endif
    </div>
  </div>
</div>
<!-- Our Latest Blog -->
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
