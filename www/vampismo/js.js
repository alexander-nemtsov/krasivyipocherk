$(document).ready(function() {

  var form = $('#form'),
      country = $('#country'),
      name = $('#name'),
      zipcode = $('#zipcode'),
      address = $('#address'),
      info = $('#info'),
      submit = $("#submit");
  
  form.on('input', '#country, #name, #zipcode, #address', function() {
    $(this).css('border-color', '');
    info.html('').slideUp();
  });
  
  submit.on('click', function(e) {
    e.preventDefault();
    if(validate()) {
      $.ajax({
        type: "POST",
        url: "demorequest.php",
        data: form.serialize(),
        dataType: "json"
      }).done(function(data) {
        if(data.success) {
          country.val('');
          name.val('');
          zipcode.val('');
          address.val('');
          info.html('Message sent!').css('color', 'green').slideDown();
        } else {
          info.html('Could not send mail! Sorry!').css('color', 'red').slideDown();
        }
      });
    }
  });
  
  function validate() {
    var valid = true;
// email regex    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    if($.trim(country.val())) {
      country.css('border-color', 'red');
      valid = false;
    }
    if($.trim(name.val()) === "") {
      name.css('border-color', 'red');
      valid = false;
    }
    if($.trim(zipcode.val()) === "") {
      message.css('border-color', 'red');
      valid = false;
    }
    if($.trim(address.val()) === "") {
      message.css('border-color', 'red');
      valid = false;
    }
    
    return valid;
  }

});