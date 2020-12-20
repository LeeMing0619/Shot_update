$(document).ready(function () {

  $('#save_job').click(function(e){

    // var event_date_ = $("<input id='event_date'>").append($('<input>', { type: 'text', val: $('#date-text-ymd2').text()}));
    //
    // alert(event_date_);

     e.preventDefault();
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
     jQuery.ajax({
        url: "http://127.0.0.1:8000/new-booking/create",
        method: 'post',
        data: {
          user_id : $("#user_id").val(),
          pro_type : $("#pro_type").val(),
          looking_to_shoot : $("#looking_to_shoot").val(),
          event_address : $("#autocomplete").val(),
          address_details : $("#address_details").val(),
          duration_ : $("#duration_").val(),
          hours_ : $("#hours_").val(),
          event_date : "event_date",
          start_time : $("#start_time").val(),
          time_zone : $("#time_zone").val(),
          allow_employee : $("#allow_employee").val(),
        },
        success: function(data){
            $.each(data.errors, function(key, value){
              $('.alert-danger').show();
              $('.alert-danger').append('<p>'+value+'</p>');
            });
        }

        });
     });
});
