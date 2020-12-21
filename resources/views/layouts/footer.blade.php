<!-- Footer -->
  <footer class="site-footer">
      <div class="footer-top">
          <div class="container">
              <div class="row">
                    <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
                      <div class="widget">
                        <h2 style="margin: 0; padding: 0;">SeempleShot</h2>
                        <ul class="list-inline m-a0">
                            <li><a href="javascript:void(0);" class="site-button white facebook circle "><i class="fa fa-facebook"></i></a></li>
                            <!-- <li><a href="javascript:void(0);" class="site-button white google-plus circle "><i class="fa fa-google-plus"></i></a></li> -->
                            <!-- <li><a href="javascript:void(0);" class="site-button white linkedin circle "><i class="fa fa-linkedin"></i></a></li> -->
                            <li><a href="javascript:void(0);" class="site-button white instagram circle "><i class="fa fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0);" class="site-button white twitter circle "><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                  </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
                      <div class="widget border-0">
                          <h5 class="m-b30 text-white">Company</h5>
                          <ul class="list-2 w10 list-line">
                              <li><a href="contact.html">Contact Us</a></li>
                              <!-- <li><a href="careers.html">Careers</a></li> -->
                              <li><a href="terms.html">Terms Of Services</a></li>
                              <li><a href="privacy.html">Privacy Policy</a></li>
                          </ul>
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
                      <div class="widget border-0">
                          <h5 class="m-b30 text-white">Join Us</h5>
                          <ul class="list-2 w10 list-line">
                              <li><a href="register.html">Become A Pro</a></li>
                          </ul>
                      </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
                      <div class="widget border-0">
                          <h5 class="m-b30 text-white">Free Resources</h5>
                          <ul class="list-2 w10 list-line">
                              <li><a href="blog.html">Our Blog</a></li>
                              <li><a href="faq.html">FAQ</a></li>
                          </ul>
                      </div>
                  </div>
                </div>
          </div>
      </div>
      <!-- footer bottom part -->
      <div class="footer-bottom">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
          <span> © Copyright 2020  by
          <a href="javascript:void(0);">SeempleShot, Inc </a> All rights reserved.</span>
        </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- Footer END -->
  <!-- scroll top button -->
  <button class="scroltop fa fa-arrow-up" ></button>
</div>

<!-- UPON DEPLOYEMENT CHANGE ASSET TO SECURE_ASSET -->
<!-- JAVASCRIPT FILES ========================================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/notify.min.js')}}"></script>
<!-- JQUERY.MIN JS -->
<script src="{{ asset('plugins/bootstrap/js/popper.min.js')}}"></script>
<!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<!-- FORM JS -->
<script src="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
<!-- FORM JS -->
<script src="{{ asset('plugins/magnific-popup/magnific-popup.js')}}"></script>
<!-- MAGNIFIC POPUP JS -->
<script src="{{ asset('plugins/counter/waypoints-min.js')}}"></script>
<!-- WAYPOINTS JS -->
<script src="{{ asset('plugins/counter/counterup.min.js')}}"></script>
<!-- COUNTERUP JS -->
<script src="{{ asset('plugins/imagesloaded/imagesloaded.js')}}"></script>
<!-- IMAGESLOADED -->
<script src="{{ asset('plugins/masonry/masonry-3.1.4.js')}}"></script>
<!-- MASONRY -->
<script src="{{ asset('plugins/masonry/masonry.filter.js')}}"></script>
<!-- MASONRY -->
<script src="{{ asset('plugins/owl-carousel/owl.carousel.js')}}"></script>
<!-- OWL SLIDER -->
<script src="{{ asset('js/custom.js')}}"></script>
<script src="{{ asset('js/bootstrap4-rating-input.js')}}"></script>
<!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('js/dz.carousel.js')}}"></script>
<!-- SORTCODE FUCTIONS  -->
<script src="{{ asset('js/dz.ajax.js')}}"></script>
<script src="{{ asset('js/step.js')}}"></script>
<script src="{{ asset('js/dragimage.js')}}"></script>
<script src="{{ asset('js/wickedpicker.js')}}"></script>
<script src="{{ asset('js/datepicker.js')}}"></script>

@yield("scripts")
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="{{ asset('js/lightgallery-all.min.js')}}"></script>
<script src="{{ asset('js/jquery.mousewheel.min.js')}}"></script>
<!-- CONTACT JS  -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDgCqSP7r9bnQ_oxU4uVk_eSZYSLcoGkc&libraries=places&callback=initAutocomplete" async defer></script>
<script src="{{ asset('js/autocompleteaddress.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins\dropify\dist\js\dropify.min.js')}}"></script>
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
                    $("#uploadPhoto").modal('hide');
                    $.each($.parseJSON(data.photo_link), function(idx, obj) {
                        $('#masonry').append('<li class="card-container col-lg-4 col-md-3 col-sm-6 col-6 cards_ ' + data.category + '" data-responsive="http://127.0.0.1:8000/storage/photos/' + obj + ' 375, http://127.0.0.1:8000/storage/photos/' + obj + ' 480, http://127.0.0.1:8000/storage/photos/' + obj + ' 800" data-src="http://127.0.0.1:8000/storage/photos/' + obj + '" data-sub-html=""><div class="dez-media dez-img-overlay1 dez-img-effect"><a href=""><img class="img-responsive" src="http://127.0.0.1:8000/storage/photos/' + obj + '"></a></div><img onclick="javascript:portfolioDelete(this, ' + data.gallery_id + ')" src="http://127.0.0.1:8000/storage/close.png" style="position: absolute; top: 4px; right: 5px;width:50px; z-index:10;"></li>');
                    });                    
                } else {
                    $.notify(data.error, "error")
                }
            },
            error: function (err) {
                $.notify("Something went Wrong, please try again!", {
                    className:'info',
                    clickToHide: true,
                    autoHide: true,
                    globalPosition: 'top left'
                });
            }
        });
    }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#masonry').lightGallery();
    $('#masonry_portofolio').lightGallery();
    $('.timepicker-12-hr').wickedpicker();
    const $valueSpan = $('.valueSpan2');
    const $value = $('#customRange11');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

        $valueSpan.html($value.val());
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#sendoffer").click(function(){
    
        if ($('#duration_').val() == '' || $('#price_').val() == '') {
            $.notify("Please make sure that all fields are filled.", {
                className:'info',
                clickToHide: true,
                autoHide: true,
                globalPosition: 'top left'
            });
            return false;
        }
        
        $.ajax({
            
            type: "POST",
            //dataType: "json",
            url: "{{ route('sendoffer') }}",
            data: {'_token': $('meta[name="_token"]').attr('content'),'client_id': $('#client').val(), 'job_id': $('#aObject').val(), 'client_email': $('#email').val(), 'job_price': $('#price_').val(), 'job_hours': $('#duration_').val()},
            success: function(data){
                $('#modal').modal('hide');
                id = $('#aObject').val();
                $('#'+id).text('Accepted');
                $('#'+id).removeAttr('onclick');
                $.notify("Your booking offer was created successfuly!", {
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
    });
    
  });
</script>
</html>
