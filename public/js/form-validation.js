$(document).ready(function(){

  // Custom method to validate username
  $.validator.addMethod("usernameRegex", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]*$/i.test(value);
  }, "Username must contain only letters, numbers");

  $(".next").click(function(){
    var form = $("#myform");
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block',
      highlight: function(element, errorClass, validClass) {
        $(element).closest('.form-group').addClass("has-error");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).closest('.form-group').removeClass("has-error");
      },
      rules: {
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        password : {
          required: true,
          minlength: 8,
        },
        password_confirmation : {
          required: true,
          minlength: 8,
          equalTo: '#password',
        },
        email: {
          required: true,
        },
        account_type: {
          required: true,
        },
        pro_type: {
          required: true,
        },
        phone_number: {
          required: true,
          minlength: 10,
        },
        receive_text: {
          required: false,
        },
        moto: {
          required: false,
        }

      },
      messages: {
        first_name: {
          required: "First name is required",
        },
        last_name: {
          required: "Last name is required",
        },
        email: {
          required: "Email is required",
        },
        password : {
          required: "Password is required",
        },
        password_confirmation : {
          required: "Password is required",
          equalTo: "Your password don't match",
        },
        pro_type: {
          required: "Your service is required",
        },
        phone_number: {
          required: "Phone number is required",
        },
      }
    });
    if (form.valid() === true){
      if ($('#account_information').is(":visible")){
        current_fs = $('#account_information');
        next_fs = $('#company_information');
      }else if($('#company_information').is(":visible")){
        current_fs = $('#company_information');
        next_fs = $('#personal_information');
      }

      next_fs.show();
      current_fs.hide();
    }
  });

  $('#previous').click(function(){
    if($('#company_information').is(":visible")){
      current_fs = $('#company_information');
      next_fs = $('#account_information');
    }else if ($('#personal_information').is(":visible")){
      current_fs = $('#personal_information');
      next_fs = $('#company_information');
    }
    next_fs.show();
    current_fs.hide();
  });

});
