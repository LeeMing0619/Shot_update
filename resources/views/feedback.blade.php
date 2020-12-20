@extends('layouts.app')
@section('title', 'SeempleShots find and dicover great talent.')
@section('css')

@endsection
@section('content')
<div class="page-content">
  <div class="container">   
    <div class="bg-white">
      <div class="" style="margin: 0 auto;">
      
          <div class="job-bx job-profile">
              <div class="container w-container">
              <form class="form-horizontal" method="POST" id="newFeedback" style="padding: 20px 0 0 0;" action="/feedback/create">
                    @csrf
                    @method("POST")
                  <h3 style="padding: 0; margin: 0 0 20px 0;">Leave a feedback</h3>
                  <h5 style="padding: 0; margin: 10px 0; font-weight: normal; font-size: 15px;">How likely are you to recommend this professional to a friend or a colleague?<p class="expired success">(0 being not likely and 10 being extremely likely)</p></h5>
                  <div class="row">                  
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="0" value="0" name="rate">
                              <label class="custom-control-label" for="0">0</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input"  id="1" value="1" name="rate">
                              <label class="custom-control-label" for="1">1</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="2" value="2" name="rate">
                              <label class="custom-control-label" for="2">2</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="3" value="3" name="rate">
                              <label class="custom-control-label" for="3">3</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="4" value="4" name="rate">
                              <label class="custom-control-label" for="4">4</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="5" value="5" name="rate">
                              <label class="custom-control-label" for="5">5</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="6" value="6" name="rate">
                              <label class="custom-control-label" for="6">6</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="7" value="7" name="rate">
                              <label class="custom-control-label" for="7">7</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="8" value="8" name="rate">
                              <label class="custom-control-label" for="8">8</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="9" value="9" name="rate">
                              <label class="custom-control-label" for="9">9</label>
                          </div>
                      </div>
                      <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                          <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="10" value="10" name="rate">
                              <label class="custom-control-label" for="10">10</label>
                          </div>
                      </div>
                  </div>
                  <div class="form-group ">                  
                    <h5 style="padding: 0; margin: 10px 0; font-weight: bold; font-size: 15px;">Rate the professional</h5>
                    <label for="input-1" class="control-label" style="margin: 0;">Skills:</label>
                    <input type="number" name="skills" id="skills" class="rating"/>
                  </div>
                  <div class="form-group ">
                    <label for="input-2" class="control-label" style="margin: 0;">Quality of work:</label>
                    <input type="number" name="quality" id="quality" class="rating"/>
                  </div>
                  <div class="form-group ">
                    <h4 style="font-weight: normal; font-size: 20px;" class="rating">Total Score <label class="rating_mark">5.0</label></h4>
                  </div>
                  <div class="form-group">
                      <label>Share your experience with this professional to the SeempleShot community.</label>
                      <textarea id="description" name="description" class="form-control" placeholder="Type Description" spellcheck="false"></textarea>
                  </div>

                  <div class="form-group">
                      <label>How was your experinece overall using SeempleShot?</label>
                      <textarea id="experience" name="experience" class="form-control" placeholder="Your experience" spellcheck="false"></textarea>
                  </div>
                  <input type="hidden" id="job_id" name="job_id" value="{{$job_id}}">
                  <button name="next" type="submit" class="site-button active">Submit Feedback</button>
              </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Our Latest Blog -->
@endsection
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
    var skills  = 0;
    var quality = 0;
    var total   = 0;
    $(document).ready(function() {
        $('#skills').change(function(){
            skills = eval($(this).val());
            total  = skills + quality;
            $('.rating_mark').text(total/2);
            // $(".custom-control-input").attr('disabled', true);
            // $(".custom-control-input").attr('checked', false); 
            // $("#"+total).attr('checked', true);
            // $("#"+total).attr('disabled', false);
            console.log(total);     
        });
        $('#quality').change(function(){
            quality = eval($(this).val());
            total   = skills + quality;
            // $(".custom-control-input").attr('disabled', true); 
            // $(".custom-control-input").attr('checked', false); 
            // $("#"+total).attr('checked', true);            
            // $("#"+total).attr('disabled', false);
            $('.rating_mark').text(total/2);
            console.log(total);
        });
    });
</script>

