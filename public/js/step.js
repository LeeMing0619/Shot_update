// see https://css-tricks.com/forums/topic/back-button-on-multistep-form/
$(function() {
    var step = 0;
    var stepItem = $('.step-progress .step-slider .step-slider-item');
  
    $('.step-content .step-content-foot button[name="prev"]').addClass('out');
    
    // Step Next
    $('.step-content .step-content-foot button[name="next"]').on('click', function() {
      var instance = $(this);
      if (stepItem.length - 1 < step) {
        return;
      }
      $('.step-content .step-content-foot button[name="prev"]').removeClass('out');
      if (step == (stepItem.length - 2)) {
        instance.addClass('out');
        instance.siblings('button[name="finish"]').removeClass('out');
      }
      $(stepItem[step]).addClass('active');
      $('.step-content-body').addClass('out');
      step++;
      $('#' + stepItem[step].dataset.id).removeClass('out');
    });
  
    // Step Last
    $('.step-content .step-content-foot button[name="finish"]').on('click', function() {
      if (step == stepItem.length) {
        return;
      }
      $(stepItem[stepItem.length - 1]).addClass('active');
      $('.step-content-body').addClass('out');
      $('#stepLast').removeClass('out');
      step++;
    });
  
    // Step Previous
    $('.step-content .step-content-foot button[name="prev"]').on('click', function() {
      if (step - 1 < 0) {
        return;
      }
      step--;
      var instance = $(this);
      if (step <= (stepItem.length - 1)) {
        instance.siblings('button[name="next"]').removeClass('out');
        instance.siblings('button[name="finish"]').addClass('out');
      }
      $('.step-content-body').addClass('out');
      $('#' + stepItem[step].dataset.id).removeClass('out');
      if (step === 0) {
        stepItem.removeClass('active');
      } else {
        stepItem.filter(':gt(' + (step - 1) + ')').removeClass('active');
      }
      if (step - 1 < 0) {
        $('.step-content .step-content-foot button[name="prev"]').addClass('out');
      }
    });
  });
  