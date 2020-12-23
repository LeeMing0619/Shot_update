@extends('layouts.app')
@section('title', 'SeempleShot Hire and Discover')

@section('content')
<div class="page-content">

  <div class="dez-media">
    <div class="dez-bnr-inr dez-bnr-inr-md">
      <div class="container">
          <div class="dez-bnr-inr-entry align-m"  style="background-color: #F9F8FD; background-image:url(images/main-slider/photography-removebg-preview.png); background-size: 40%; background-position: right; background-repeat: no-repeat;">
            <div class="find-job-bx col-xl-8 col-lg-8">
              <h2 style="color: #333;">The one place to discover and hire great talent.</h2>
              <a href="post_job.html" title="READ MORE" class="site-button"><i class="fa fa-file-text-o"></i> Book Now</a>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="section-full job-categories content-inner-2 bg-white">
    <div class="container">
      <div class="section-head d-flex head-counter clearfix">
        <div class="mr-auto">
          <h2 class="m-b5">Portrait, Events, Commercial, Food and Sport</h2>
          <h6 class="fw3">20+ Catetories work wating for you</h6>
        </div>
      </div>
      <div class="row sp20">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="icon-bx-wraper">
            <div class="icon-content">
              <div class="icon-md text-primary m-b20"><i class="ti-bar-chart"></i></div>
              <a href="more-categories.html" class="dez-tilte">Weddings</a>
              <!-- <div class="rotate-icon"><i class="ti-bar-chart"></i></div>  -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="icon-bx-wraper">
            <div class="icon-content">
              <div class="icon-md text-primary m-b20"><i class="ti-tablet"></i></div>
              <a href="more-categories.html" class="dez-tilte">Religious</a>
              <!-- <div class="rotate-icon"><i class="ti-tablet"></i></div>  -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="icon-bx-wraper">
            <div class="icon-content">
              <div class="icon-md text-primary m-b20"><i class="ti-camera"></i></div>
              <a href="more-categories.html" class="dez-tilte">Date</a>
              <!-- <div class="rotate-icon"><i class="ti-camera"></i></div>  -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="icon-bx-wraper">
            <div class="icon-content">
              <div class="icon-md text-primary m-b20"><i class="ti-panel"></i></div>
              <a href="more-categories.html" class="dez-tilte">Pet</a>
              <!-- <div class="rotate-icon"><i class="ti-panel"></i></div>  -->
            </div>
          </div>
        </div>
        <div class="col-lg-12 text-center m-t30" style="clear: both; text-align: right!important;">
          <a href="more-categories.html" title="View all categories" class="site-button">View All Categories <i class="fa fa-long-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="section-full p-tb70 text-center bg-img-fix" style="background-color: #F9F8FD;">
    <div class="container">
      <div class="section-head text-left" style="clear: both; text-align: left;">
        <h2 class="m-b5">This is what clients think about SimpleShot.</h2>
        <h5 class="fw4">Few words from actual clients</h5>
      </div>
      <div class="blog-carousel-center owl-carousel owl-none">
        <div class="item">
          <div class="testimonial-5">
            <div class="testimonial-text">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.</p>
            </div>
            <div class="testimonial-detail clearfix">
              <div class="testimonial-pic radius shadow">
                <img src="images/testimonials/pic1.jpg" width="100" height="100" alt="">
              </div>
              <strong class="testimonial-name">David Matin</strong>
              <span class="testimonial-position">Student</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="testimonial-5">
            <div class="testimonial-text">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.</p>
            </div>
            <div class="testimonial-detail clearfix">
              <div class="testimonial-pic radius shadow">
                <img src="images/testimonials/pic2.jpg" width="100" height="100" alt="">
              </div>
              <strong class="testimonial-name">David Matin</strong>
              <span class="testimonial-position">Student</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="testimonial-5">
            <div class="testimonial-text">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.</p>
            </div>
            <div class="testimonial-detail clearfix">
              <div class="testimonial-pic radius shadow">
                <img src="images/testimonials/pic3.jpg" width="100" height="100" alt="">
              </div>
              <strong class="testimonial-name">David Matin</strong>
              <span class="testimonial-position">Student</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-full content-inner-2 overlay-white-middle" style="background-image:url(images/lines.png); background-position:bottom; background-repeat:no-repeat; background-size: 100%;">
    <div class="container">
      <div class="section-head text-black text-left">
        <h2 class="m-b0">Let our professionals inspire you for your next event </h2>
      </div>
      <!-- Pricing table-1 Columns 3 with gap -->
      <!-- <div id="video-gallery">
        <a href="https://www.youtube.com/embed/TcOaA2vfye8" >
          <img src="http://i3.ytimg.com/vi/TcOaA2vfye8/maxresdefault.jpg" />
        </a>
        </div> -->
      <div class="demo-gallery">
        <ul id="masonry" class="list-unstyled row dez-gallery-listing gallery-grid-4 gallery mfp-gallery sp10">
          @forelse($gallery as $galleries)
            @foreach (json_decode($galleries->picture) as $picture)
          <li class="card-container col-lg-4 col-md-3 col-sm-6 col-6 cards_" data-responsive="http://127.0.0.1:8000/storage/photos/{{$picture}} 375, http://127.0.0.1:8000/storage/photos/{{$picture}} 480, http://127.0.0.1:8000/storage/photos/{{$picture}} 800" data-src="http://127.0.0.1:8000/storage/photos/{{$picture}}" data-sub-html="
              <div style='text-align: left;'>
                <div class='testimonial-detail clearfix'>
                    <strong class='testimonial-name' style='color: #fff; font-size: 14px;'><a href='/pro-profile/{{ $galleries->user_id }}'>{{ \App\User::where('id', $galleries->user_id)->first()->first_name}} {{ \App\User::where('id', $galleries->user_id)->first()->last_name}}</a></strong>
                    <div class='post-tags'>
                    @if(\App\Feedback::where('pro_id', $galleries->user_id)->first())
                      @for($i=0; $i<5; $i++)
                        @if ($i < floor((\App\Feedback::where('pro_id',$galleries->user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$galleries->user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$galleries->user_id)->count()))
                          <span class='fa fa-star'></span>
                        @elseif ($i < round((\App\Feedback::where('pro_id',$galleries->user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$galleries->user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$galleries->user_id)->count()))
                          <span class='fa fa-star-half-o'></span>
                        @else
                          <span class='fa fa-star-o'></span>
                        @endif
                      @endfor
                      <span><strong>{{ (\App\Feedback::where('pro_id',$galleries->user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$galleries->user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$galleries->user_id)->count() }}</strong></span>
                    @endif
                        
                    </div>
                    <span class='testimonial-position' style='font-size: 12px;'>{{ \App\User::where('id', $galleries->user_id)->first()->pro_type}} {{ \App\User::where('id', $galleries->user_id)->first()->business_adress}}</span>
                    <div class=''>
                        <a href='send-offer.html' class='site-button add-btn button-sm' style='padding: 5px 10px; font-size: 14px;'>Send Offer</a>
                    </div>
                </div>
            </div>
          ">
            <div class="dez-media dez-img-overlay1 dez-img-effect">
              <a href="">
                <img class="img-responsive" src="http://127.0.0.1:8000/storage/photos/{{$picture}}">
              </a>
              <div style="text-align: left; position: absolute; bottom: 5px; left: 5px;" class="dss">
                <div class="testimonial-detail clearfix">
                  <strong class="testimonial-name pr_name">{{ \App\User::where('id', $galleries->user_id)->first()->first_name}} {{ \App\User::where('id', $galleries->user_id)->first()->last_name}}</strong>
                  <div class="post-tags" style="color: #fff;">
                  @if(\App\Feedback::where('pro_id', $galleries->user_id)->first())
                    @for($i=0; $i<5; $i++)
                      @if ($i < floor((\App\Feedback::where('pro_id',$galleries->user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$galleries->user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$galleries->user_id)->count()))
                        <span class="fa fa-star"></span>
                      @elseif ($i < round((\App\Feedback::where('pro_id',$galleries->user_id)->sum('skills') / 2 + \App\Feedback::where('pro_id',$galleries->user_id)->sum('quality') / 2) / \App\Feedback::where('pro_id',$galleries->user_id)->count()))
                        <span class="fa fa-star-half-o"></span>
                      @else
                        <span class="fa fa-star-o"></span>
                      @endif
                    @endfor
                  @endif
                  </div>
                  <span class="testimonial-position pr_name" style="font-size: 12px; color: #fff;">{{ \App\User::where('id', $galleries->user_id)->first()->pro_type}}</span>
                </div>
              </div>
            </div>
          </li>
            @endforeach
          @empty

          @endforelse
        </ul>
        <div class="pagination-bx m-t30">
          {{$gallery->links()}}
        </div>
      </div>
      <div class="col-lg-12 text-center m-t30" style="clear: both; text-align: right!important;">
        <a href="discover.html" class="site-button">Discover More  <i class="fa fa-long-arrow-right"></i></a>
      </div>
    </div>
  </div>
  <!-- Our Latest Blog -->

</div>
@endsection
