
@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
<style media="screen">
.package_nam {font-size: 20px; font-weight: 600;}
.list_pck {border-bottom: 1px solid #dcdde1; padding: 15px 5px;}
.list_pck:hover {background-color: #f4f4f4;}
.package_media {width: 128px; height: 128px; background-color:rgba(189, 195, 199,1.0); border-radius: 3px; margin: 0 15px 0 0; position: relative;}
.package_price{position: absolute; top: 0; right:0; background: red; padding: 5px 15px; background: rgba(47, 54, 64,0.5); color: #fff; font-weight: 600;}
img {
  display: block;
  max-width: 100%;
}
.preview {
  overflow: hidden;
  width: 160px;
  height: 160px;
  margin: 10px;
  border: 1px solid red;
}
.modal-lg{
  max-width: 1000px !important;
}
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
                  <img alt="" id="profile_preview_container" src="photos/{{$profile}}">
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
              <h2 class="m-b0 pr_name" style="color: #222;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                <a class="m-l15 font-16 text-white" data-toggle="modal" data-target="#profilename" href="#"><i class="fa fa-pencil"></i></a>
              </h2>
              @if(\App\Feedback::where('pro_id',Auth::user()->id)->first())
                <p><i class="fa fa-star"></i> {{(\App\Feedback::where('pro_id',Auth::user()->id)->sum('skills') / 2 + \App\Feedback::where('pro_id',Auth::user()->id)->sum('quality') / 2) / \App\Feedback::where('pro_id',Auth::user()->id)->count() }}</p>
              @endif
              <p class="m-b15" style="color: #222;margin: 15px 0;">
                {{ Auth::user()->moto }}
              </p>
              <ul class="clearfix">
                <li style="float: left;"><i class="ti-location-pin float-left"></i> {{ Auth::user()->area }}, {{ Auth::user()->business_adress }}</li>
                <li><i class="ti-camera float-left"></i> <span class="pr_name">{{ Auth::user()->pro_type }}</span></li>
              </ul>
              <div class="job-time mr-auto">

              </div>
            </div>
          </div>
        </div>
			</div>
    </div>      
    @if(Auth::user()->phone_number == 'none' || Auth::user()->moto == 'none' || Auth::user()->business_adress == 'none' || \App\ProPackage::where('user_id', Auth::user()->id)->get()->count() == 0 || \App\ProSchedule::where([['user_id', Auth::user()->id],['days', '!=','']])->get()->count() == 0)
		<div class="col-lg-4 col-md-5">
			<div class="pending-info text-white p-a25">
				<h5>Pending Action</h5>
				<ul class="list-check secondry">
          @if(Auth::user()->phone_number == 'none' || Auth::user()->moto == 'none' || Auth::user()->business_adress == 'none')
          <li><a href="{{ route('settings.index') }}" style="color: #fff; text-decoration: none;">Business Info Missing</a></li>
          @endif          
          @if(\App\ProPackage::where('user_id', Auth::user()->id)->get()->count() == 0)
          <li><a href="{{ route('package.index') }}" style="color: #fff; text-decoration: none;">Business Packages Missing</a></li>
          @endif         
          @if(\App\ProSchedule::where([['user_id', Auth::user()->id],['days', '!=','']])->get()->count() == 0)
          <li><a href="{{ route('schedule.index') }}" style="color: #fff; text-decoration: none;">Business Open Days Missing</a></li>
          @endif
				</ul>
			</div>
    </div>
    @endif
	</div>
</div>
</div>
<div class="page-content">
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/home') active @endif" href="/home"><i class="fa fa-briefcase" aria-hidden="true"></i> Portfolio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/home?tab=reviews') active @endif" href="/home?tab=reviews"><i class="fa fa-comments" aria-hidden="true"></i> Review</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(URL::full() == 'http://127.0.0.1:8000/home?tab=services') active @endif" href="/home?tab=services"><i class="fa fa-id-card-o" aria-hidden="true"></i> Services</a>
      </li>
    </ul>
    
    <div class="" style="padding: 25px 0 0 0;">
      @if(URL::full() == "http://127.0.0.1:8000/home")
        @include('professional.includes.portfolio', [
        'gallery' => $pro_gallery
        ])
      @elseif(URL::full() == "http://127.0.0.1:8000/home?tab=reviews")
        @include('professional.includes.reviews')
      @elseif(URL::full() == "http://127.0.0.1:8000/home?tab=services")
        @include('professional.includes.dashboard', [
        'packages' => $packages
        ])
      @endif
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade modal-bx-info editor" id="modal_profile" tabindex="-1" role="dialog" aria-labelledby="ProfilesummaryModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ProfilesummaryModalLongTitle">Change profile image.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="img-container">
            <div class="row">
                <div class="col-md-8">
                    <img id="preview_image" src="https://avatars0.githubusercontent.com/u/3456749">
                </div>
                <div class="col-md-4">
                    <div class="preview"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="site-button" id="crop">Upload Image</button>
        <!-- <button type="button" class="btn site-button" id="crop" style="color: #fff;">Upload Photo</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<!-- Our Latest Blog -->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script type="text/javascript">

var $modal = $('#modal_profile');
var image = document.getElementById('preview_image');
var cropper;

$("body").on("change", "#profile_image", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $modal.modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
	  aspectRatio: 1,
	  viewMode: 3,
	  preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
	    width: 160,
	    height: 160,
      });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob);
         
         reader.onloadend = (e) => {
            var base64data = reader.result;
            $('#profile_preview_container').attr('src', e.target.result);
            $.ajax({
              
                type: "POST",
                //dataType: "json",
                url: "{{ route('changeProfileBase64') }}",
                data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                success: function(data){
                    $modal.modal('hide');
                    $.notify("Profile image changed successfuly!", {
                      className:'success',
                      clickToHide: true,
                      autoHide: true,
                      globalPosition: 'top left'
                    });
                },
                error: function(data){
                    console.log(data);
                }
              });
         }
    });
})
</script>
@endsection
