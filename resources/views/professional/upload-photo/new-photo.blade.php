@extends('layouts.app')
@section('css')
<!-- Dropify -->
<link rel="stylesheet" href="{{asset('plugins\dropify\dist\css\dropify.min.css')}}">
<style media="screen">

</style>
@endsection
@section('content')
<div class="container">
    <div class="col-xl-9 col-lg-8" style="margin: 20px auto;">
      <form method="POST" id="saveForm" enctype="multipart/form-data">
           @csrf
           @method('GET')
           <div class="col-md-12">
               <div class="form-group">
                 <input type="file" name="picture[]" class="dropify" data-height="300" data-allowed-file-extensions="jpg jpeg png gig" multiple/>
               </div>
               <div class="form-group">
                 <select class="form-control" name="category">
                   <option value="pet">Pet</option>
                   <option value="birthday">Birthday</option>
                 </select>
               </div>
               <button type="button" class="btn btn-primary btn-block" id="saveImage">Save</button>
           </div>
       </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('plugins\dropify\dist\js\dropify.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/notify.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/notify.js')}}"></script>
<script>
    $('.dropify').dropify();
    $(function () {
        $(document).on("click", "#saveImage", function (event) {
            let myForm = document.getElementById('saveForm');
            let formData = new FormData(myForm);
            uploadImage(formData);
            console.log(formData);
        });
    });
    function uploadImage(formData) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            url: "{{ route('store-photo') }}",
            success: function (data) {
                if (data.status) {
                    $.notify(data.message, "success");
                } else {
                    $.notify(data.error, "error")
                }
            },
            error: function (err) {
                $.notify('Something went Wrong!', "info")
            }
        });
    }
</script>
@endsection
