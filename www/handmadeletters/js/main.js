$(document).ready(function(){

	  //------------------------------------//
  //navbar fade//
  //------------------------------------//


  //------------------------------------//
  //Scroll To//
  //------------------------------------//
  $(".scroll").click(function(event){		
  	event.preventDefault();
  	$('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
  	
  });

  var form = $('#form'),
      country = $('#country'),
      name = $('#name'),
      zipcode = $('#zipcode'),
      address = $('#address'),
      info = $('#after_submit'),
      submit = $("#submit");
  
  form.on('input', '#country, #name, #zipcode, #address', function() {
    $(this).css('border-color', '');
    info.html('').slideUp();
  });
  
  submit.on('click', function(e) {
    e.preventDefault();
    if(validate()) {
	    blockSend(true)
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
          info.html('Спасибо за заявку! Через несколько дней загляните в ваш почтовый ящик.');
          info.css('display', 'block');
          form.css('display', 'none');
        } else {
          info.html('Could not send mail! Sorry!').css('color', 'red').slideDown();
        }
        blockSend(false);
      });
    }
  });
  
  function validate() {
    var valid = true;
// email regex    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    if($.trim(country.val()) === "" ) {
      country.css('border-color', 'red');
      valid = false;
    }
    if($.trim(name.val()) === "") {
      name.css('border-color', 'red');
      valid = false;
    }
    if($.trim(zipcode.val()) === "") {
      zipcode.css('border-color', 'red');
      valid = false;
    }
    if($.trim(address.val()) === "") {
      address.css('border-color', 'red');
      valid = false;
    }
    
    return valid;
  }
  
  function blockSend(block) {
	  $("#submit").value = block ? "Processing..." : "Send";
	  $("#submit").prop('disabled', block);
  }

});