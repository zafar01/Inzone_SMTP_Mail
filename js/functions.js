jQuery(document).ready(function() {
	
	
	
	jQuery('#myform').validate({ // initialize the plugin
        rules: {
            sformemail: {
                required: true,
                email: "required email"
            },
            sformname: {
                required: true,
                minlength: 5
            },
			sformphone: {
                required: true,
                minlength: 5
            },
			sformmessage: {
                required: true,
                minlength: 10
            }
        },messages: {
        sformname: "Enter your Full Name",
        sformphone: "Enter your Phone No.",
		sformmessage: "Enter your Message minimum 3 Words",
		              
        email: {
                required: "Enter your Email",
                email: "Please enter a valid email address.",
            }
    },
        submitHandler: function (form) { // for demo
            
           jQuery("#loading").fadeIn('slow');
           jQuery("#sform-submit-wrap").hide();
         
            var name = jQuery("#sformname").val();
	        var email = jQuery("#sformemail").val();
	        var phone = jQuery("#sformphone").val();
	        var mess = jQuery("#sformmessage").val();
	        
			 
	     var cap = grecaptcha.getResponse();
		 
	        var data = {
		      'action': 'the_ajax_hook_get_captcha',
              'name':name,
			  'email':email,
			  'phone':phone,
			  'mess':mess,
			  'captcha': cap
			  
	         };	 
	       jQuery.post(the_ajax_script.ajaxurl, data,
    function(response_from_the_action_function){
		console.log(response_from_the_action_function);
		if(response_from_the_action_function == 'success'){
		jQuery("#sform-success").show();
		 jQuery("#myform")[0].reset();
		 
		 jQuery('#sform-success').delay(5000).fadeOut('slow');
		 
		}else{
			jQuery("#sform-error").show();
			jQuery('#sform-error').delay(5000).fadeOut('slow');
		}
		
		grecaptcha.reset();
		   
		  jQuery('#loading').fadeOut('slow'); 
		  jQuery('#sform-submit-wrap').fadeIn(3000);
            
	});
            return false; // for demo
        }
    });

 
	
	
	 
	
	
	
});