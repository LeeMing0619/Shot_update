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
      <a href="{{ route('viewpackage', serialize($package->id)) }}" class="site-button add-btn button-sm">View Package</a>
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
