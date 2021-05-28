<?php

add_action( 'wp_ajax_the_ajax_hook_get_captcha', 'elitbuzz_action_function_get_captcha' );
add_action( 'wp_ajax_nopriv_the_ajax_hook_get_captcha', 'elitbuzz_action_function_get_captcha' ); //


 // THE FUNCTION
function elitbuzz_action_function_get_captcha(){
  $get_smtp = json_decode(get_option('smtp_mail_inzone'));
  $mailtype = isset($get_smtp->mailtype)?$get_smtp->mailtype:null;
  $host = isset($get_smtp->host)?$get_smtp->host:null;
  $port =isset($get_smtp->port)?$get_smtp->port:null;
  $user = isset($get_smtp->user)?$get_smtp->user:null;
  $password = isset($get_smtp->password)?$get_smtp->password:null;
  $temail = isset($get_smtp->femail)?$get_smtp->femail:null;
  $subject = isset($get_smtp->subject)?$get_smtp->subject:null;
  $skey = isset($get_smtp->skey)?$get_smtp->skey:'6Leife0aAAAAAKdwyl7KDz7Dv7r2-W_CpXb4MyNe';
  
  $email;$comment;$captcha;
  if(isset($_POST['name'])){
    $name=$_POST['name'];
  }
  if(isset($_POST['email'])){
    $email=$_POST['email'];
  }
  if(isset($_POST['phone'])){
    $phone=$_POST['phone'];
  }
  if(isset($_POST['mess'])){
    $mess=$_POST['mess'];
  }
  if(isset($_POST["captcha"])){
    $captcha=$_POST["captcha"];
  }
  if(!$captcha){
    echo 'captcha_error';
    exit;
  }



  $body = ' <table width="50%" border="1" cellspacing="0" cellpadding="10">
  <tr>
    <td width="20%" bgcolor="#F3F3F3"><strong>Name :</strong></td>
    <td width="80%" bgcolor="#F3F3F3">'. $name .'</td>
  </tr>
  <tr>
    <td><strong>Email :</strong></td>
    <td>'. $email .'</td>
  </tr>
  <tr>
    <td bgcolor="#F3F3F3"><strong>Phone :</strong></td>
    <td bgcolor="#F3F3F3">'. $phone .'</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Message :</strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F3F3F3">'. $mess .'</td>
  </tr>
</table>
';


    //$secretKey = '6Leife0aAAAAAKdwyl7KDz7Dv7r2-W_CpXb4MyNe';
  $secretKey = "$skey";
  $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response,true);

	// should return JSON with success as true
  if($responseKeys["success"]) {

   if($mailtype == 'smtp'){
	
	// SMTP Mail 
     include( plugin_dir_path( __FILE__ ) . '/smtp/PHPMailerAutoload.php');
     

     $mail = new PHPMailer;
     $mail->isSMTP();
     $mail->Host       = 'host45.registrar-servers.com';
     $mail->SMTPAuth = 'true';
     $mail->SMTPSecure = 'ssl';
     $mail->Port       = 465; 
     $mail->Username   = "$user";
     $mail->Password   = "$password";
     $mail->Subject = "$subject";
     $mail->setFrom("$user", "$name");
	 $mail->addReplyTo("$email", "$name");
     $mail->isHTML(true);  
     $mail->Body    =  $body ;
     $mail->addAddress("$temail", 'Joe User');
     $mail_report = $mail->send();
     
	
     $mail->smtpClose();
    
	// End SMTP

   }else{
	// Wordpress Mail
   $to = "$temail";
    $subject = $subject;
    $body = $body; 
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[]   = "Reply-To: $name <$temail>";
    $mail_report = wp_mail( $to, $subject, $body, $headers );
  
				// End Wordpress Mail
  }


  
} else {
 $mail_result =  'error';
}


  
	 if($mail_report == 1){
       $mail_result = 'success';
    }else{
       $mail_result =  'error'; 
    }

echo $mail_result;

die();
}