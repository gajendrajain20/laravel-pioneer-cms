$(document).ready(function () {
	
    $.fn.myfunction = function (event) {

//        var response = grecaptcha.getResponse();
//        if (response.length == 0)
//        {
//            //reCaptcha not verified
//            $labelHtml = "<label id='captcha-error' class='error'>Please Complete captcha challenge</label>";
//            $(".g-recaptcha").append($labelHtml);
//            return false;
//        } else
//        {
//            //reCaptch verified
//            console.log("Captha verified");
//        }
  
      $("#submitForm").attr("disabled", true);
	
        $.post($('#postFormID').attr('action'), $("#postFormID").serialize(), function (result) {
			 $("#message").empty();
				if(result == "Success"){
					$html  = 	"<div class='alert alert-success fade in' style='margin-top:18px;'>"+
									"<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>x</a>"+
									"<strong>Success!</strong>  Query Successfully Submitted."+
								"</div>";
								 $("#submitForm").removeAttr("disabled");
				}else{
					$html  = 	"<div class='alert alert-danger fade in' style='margin-top:18px;'>"+
									"<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>x</a>"+
									"<strong>Success!</strong>  Query Submission Failed."+
								"</div>";
								 $("#submitForm").removeAttr("disabled");
				}
				
				$("#message").append($html);
				
				// Scrolling to message div
				$scrollPos = $(window).scrollTop();
				console.log($scrollPos);
				if($scrollPos>130)
				{
					$('html, body').animate({scrollTop:0}, 'slow');
				}
				
				$('#postFormID').trigger("reset");
			});
		
		
   }; 
   
   $("form[name='contactForm']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  name: "required",
		  email: {
			required: true,
			// Specify that email should be validated
			// by the built-in "email" rule
			email: true
		  },
		  number: {
			required: true,
			// Specify that number should be validated
			// by the built-in "number" rule
			number: true
		  },
		  subject: "required",
		  message: "required",
		  file: "required"
		},
		// Specify validation error messages
		messages: {
		  name: "Please enter your Name",
		  subject: "Please enter your Subject",
		  email: {
			required: "Please provide an E-mail",
			email: "Please enter a valid E-mail"
		  },
		  number:{
			required: "Please provide your number",
			number: "Please enter a valid number"
		  },
		  message: "Please enter your message",
		  file: "Please upload your file"
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			//alert("In Validate method");
			//form.submit();
			$('#submitForm').myfunction();
            return false;
		}
	});
	
	
});
