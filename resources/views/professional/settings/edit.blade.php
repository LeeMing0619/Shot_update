@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('content')
<!-- Product -->
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 m-b30">
        <h3>Edit More Packages</h3>
        <div class="sticky-top bg-white job-bx" style="padding: 0; z-index: 1;">
          <div class="candidate-info onepage">
            <ul>
              @foreach($all_package as $more_package)
                <li><a href="{{ route('package.edit', $more_package->id) }}" class="" style="text-decoration: none;">{{$more_package->category}} <span class="badge bg-success float-right" style="color: #fff; padding: 8px 5px;">{{$more_package->currency}}{{$more_package->price}}/hrs</span></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12" style="overflow: hidden;">
        <div class="m-b30">
          <a href="/package" class="site-button right-arrow button-sm float-right">Back</a>
          <div class="package_header">
            <h1 class="text-secondry m-r30 pr_name" style="font-weight: 700; margin: 0 0 15px 0;">Package: {{ $package->category }}</h1>
            <form action="{{ route('package.update', $package->id) }}" method="POST">
              @csrf
              @if(isset($package))
                @method('PUT')
              @endif
              <ul class="job-info">
        				<li>
                  <h4 style="padding: 0; margin: 0; color: #555;">
                    <div class="col-lg-12 col-md-12">
                      <div class="col-lg-4 col-md-4 float-left" style="padding: 0;">
                        <div class="form-group">
                          <select class="form-control" name="currency" >
                            <option value="$">USD</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-5 col-md-5 float-left" style="padding: 0 0 0 3px;">
                        <div class="form-group">
                          <input type="number" class="form-control" name="price" id="profileinput" placeholder="0.00" value="{{ $package->price }}">
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 float-left" style="padding: 0 0 0 3px;">
                        <div class="form-group">
                          /Hour
                        </div>
                      </div>
                    </div>
                  </h4>
                </li>
        			</ul>
            </div>
            <div  style="margin: 25px 0;">
              <h5 class="font-weight-600" style="font-size:25px;">What you will offer:</h5>
              <div class="form-group">
                <input type="hidden" name="details" id="details">
                <textarea name="details" rows="12" class="form-control" id="packageDetails">{!! html_entity_decode($package->details) !!}</textarea>
              </div>
              <div class="form-group">
                  <label for="email">{{ __('Equipment') }}</label>
                  <div class="col-md-12" style="padding: 0;">
                    <input id="phone_number" type="text" class="form-control" name="equipment" autocomplete="off" placeholder="Equipement" value="{{ $package->equipment }}">
                  </div>
              </div>
              <div class="form-group">
                  <label for="email">{{ __('Lenses') }}</label>
                  <div class="col-md-12" style="padding: 0;">
                    <input id="phone_number" type="text" class="form-control" name="lenses" autocomplete="off" placeholder="Lenses" value="{{ $package->lenses }}">
                  </div>
              </div>
              <div class="form-group">
                <button type="submit" name="button" class="site-button button">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('css')

@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/1jqtj0lqec7uhp629mffv57xs2up7diq8xuytuzwj0yse2ae/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'#packageDetails'});</script>
@endsection
@endsection
