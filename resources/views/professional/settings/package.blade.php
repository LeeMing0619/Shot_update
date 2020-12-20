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
<!-- Product -->
<div class="page-content">
  <div class="container">
    @if(session()->has('success'))
      <div class="alert alert-success">
        {{session()->get('success')}}
      </div>
    @endif
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 m-b30">
        <div class="sticky-top bg-white job-bx" style="padding: 0;">
          @include("professional.includes.settings-nav")
        </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12" style="overflow: hidden;">
        <div id="resume_headline_bx" class=" m-b30" style="display: block;">
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="list-group">
                @foreach($errors->all() as $error)
                  <li class="text-danger">{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
            <div>
              <div class="d-flex">
                <h3 class="m-b15">Create Package</h3>
              </div>
              <div class="" style="margin: 0px 0 30px 0;">
                  <a href="#" data-toggle="modal" data-target="#create_package" class="site-button button" style=" font-weight: bold;">Create Package <i class="fa fa-plus"></i></a>
              </div>
              @foreach($packages as $package)
              <div class="form-row list_pck">
                <div class="form-group col-md-2">
                  <div class="package_media">

                    <span class="package_price">
                      {{$package->currency}}{{$package->price}}/hr
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-10" style="position: relative;">
                  <p class="mb-1 package_nam">{!! html_entity_decode($package->category) !!}</p>
                  <p class="mb-1">{!! html_entity_decode($package->equipment) !!}</p>
                  <p class="mb-1">{!! html_entity_decode($package->lenses) !!}</p>
                  <p style="position: absolute; right: 5px; top: 0px;">
                    <a href="{{ route('package.edit', $package->id) }}" style="font-size: 20px;"><i class="fa fa-pencil"></i></a>
                    <a data-toggle="modal" data-target="#exampleModalCenter" onclick="handleDelete({{$package->id}})" style="font-size: 20px;"><i class="ti-trash"></i></a>
                  </p>
                </div>
              </div>
                <!-- <div class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h3 class="mb-1 pr_name">{{$package->category}}</h3>
                    <small><span class="badge badge-success badge-pill" style="padding: 10px 15px; font-size: 14px; font-weight: 500; border-radius: 3px;">{{$package->currency}}{{$package->price}}/hr</span></small>
                  </div>
                  <p class="mb-1">{!! html_entity_decode($package->details) !!}</p>
                  <p>
                    <a href="{{ route('package.edit', $package->id) }}"><i class="fa fa-pencil"></i></a>
                    <a data-toggle="modal" data-target="#exampleModalCenter" onclick="handleDelete({{$package->id}})" style="font-size: 14px;"><i class="ti-trash"></i></a>
                  </p>
                </div> -->
                @endforeach
              <div class="col-lg-12 col-md-12">

                <div class="">
                  <!-- Modal -->
                  <div class="modal fade modal-bx-info editor" id="create_package" tabindex="-1" role="dialog" aria-labelledby="ProfilesummaryModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="{{ route('package.create') }}" method="POST">
                        @csrf
                        @method("GET")
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ProfilesummaryModalLongTitle">Create New Package</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p></p>

                            <div class="row">
                              <div class="col-lg-6 col-md-6">
                                  <div class="form-group">
                                    <label>Package Category:</label>
                                    <div class="form-group">
                                      <select class="form-control" name="category">
                                        @foreach($main_categories as $categories)
                                          <option value="{{$categories->category}}">{{$categories->category}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-12 col-md-12">
                                <div class="col-lg-3 col-md-3" style="padding: 0;">
                                  <label>Hourly Rate:</label>
                                </div>
                                <div class="col-lg-2 col-md-2 float-left" style="padding: 0;">
                                  <div class="form-group">
                                    <select class="form-control" name="currency" >
                                      <option value="$">USD</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4 col-md-4 float-left" style="padding: 0 0 0 3px;">
                                  <div class="form-group">
                                    <input type="number" class="form-control" name="price" id="profileinput" placeholder="0.00">
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                  <label>What will you offer:</label>
                                  <textarea name="details" rows="8" class="form-control" id="packageDetails"></textarea>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12">
                                  <div class="form-group">
                                    <label for="email">{{ __('Equipment') }}</label>
                                    <div class="form-group">
                                      <input id="equipment" type="text" class="form-control" name="equipment" autocomplete="off" placeholder="">
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-12 col-md-12">
                                  <div class="form-group">
                                    <label for="email">{{ __('Lenses') }}</label>
                                    <div class="form-group">
                                      <input id="lenses" type="text" class="form-control" name="lenses" autocomplete="off" placeholder="">
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="site-button" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="site-button">Create</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  <!-- Modal End -->
                </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <form action="" method="POST" id="delete_packake_form">
          @csrf
          @method('DELETE')
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                Are you sure you want to delete this package?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes delete</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        <script type="text/javascript">
          function handleDelete(id){
            var form = document.getElementById("delete_packake_form")
            form.action = '/package/'+id
          }
        </script>
      </div>
		</div>
  </div>
</div>
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/1jqtj0lqec7uhp629mffv57xs2up7diq8xuytuzwj0yse2ae/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'#packageDetails'});</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous"></script>
@endsection
<!-- Product END -->
@endsection
