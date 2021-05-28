jQuery(document).ready(function() {
 var mailtype = jQuery("#mailtype").val();
 	if(mailtype == 'wp'){
		jQuery("#host_h").hide();
		jQuery("#port_h").hide();
		jQuery("#user_h").hide();
		jQuery("#pass_h").hide();
	}
 
jQuery( "#mailtype" ).change(function() {
	var mailtype = jQuery("#mailtype").val();
	 jQuery("label.error").hide();
     jQuery(".error").removeClass("error");
	if(mailtype == 'smtp'){
		jQuery("#host_h").show();
		jQuery("#port_h").show();
		jQuery("#user_h").show();
		jQuery("#pass_h").show();
	}else{
		jQuery("#host_h").hide();
		jQuery("#port_h").hide();
		jQuery("#user_h").hide();
		jQuery("#pass_h").hide();
	}
});
	
    jQuery( "#btnsave" ).click(function() {
		var mailtype = jQuery("#mailtype").val();
		console.log(mailtype);
		if(mailtype == 'smtp'){
			 /*** SMTP Validation**/
			 jQuery('#addsmtp').validate({ // initialize the plugin
        rules: {
            host: {
                required: true,
                
            },
            port: {
                required: true,
                 
            },
			femail: {
                required: true,
                email: "required email"
            },
			subject: {
                required: true,
                
            },
			sitekey: {
                required: true,
                
            },
			skey: {
                required: true,
                
            },
			user: {
                required: true,
                email: "required email"
            },
			
			password: {
                required: true,
                
            }
        },messages: {
		host: "Enter your Full Name",
		port: "Enter your Full Name",
		femail: {
                required: "Enter your Email",
                email: "Please enter a valid email address.",
            },
		subject: "Enter your Full Name",
		sitekey: "Enter your Full Name",
        skey: "Enter your Phone No.",
		password: "Enter your password",
        user: {
                required: "Enter your Email",
                email: "Please enter a valid email address.",
            }
    },
	});
		}else{
			
			
			/*** WP Validation**/
			jQuery('#addsmtp').validate({ // initialize the plugin
        rules: {
            
			femail: {
                required: true,
                email: "required email"
            },
			subject: {
                required: true,
                
            },
			sitekey: {
                required: true,
                
            },
			skey: {
                required: true,
                
            }
			 
        },messages: {
		
		femail: {
                required: "Enter your Email",
                email: "Please enter a valid email address.",
            },
		subject: "Enter your Full Name",
		sitekey: "Enter your Full Name",
        skey: "Enter your Phone No."
		 
    },
	});
		}
		
	});
		
		
	

	 
	
	
	});