<?php

add_action( 'admin_menu', 'inzone_plugin_menu' );

/** Step 1. */
function inzone_plugin_menu() {
  add_options_page( 'SMTP MAIL Setting', 'SMTP MAIL', 'manage_options', 'smtp-mail-setting', 'inzone_smtp_mail_setting' );
}

function  inzone_setting_admin_init(){
  
  $url = plugin_dir_url(__FILE__);
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'jquery.validate', $url.'js/jquery.validate.js' );
  wp_enqueue_style( 'admin-css', plugins_url('css/admin-css.css', __FILE__) );
  wp_enqueue_script(
    'validate-admin',
    'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js', 
    array('jquery') 
  );
  
}
add_action( 'admin_head', 'inzone_setting_admin_init' );

/** Step 3. */
function inzone_smtp_mail_setting() {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  $check = json_decode(get_option('smtp_mail_inzone'));
  if(isset($_POST['btnsave'])){
    
    $array['mailtype']= trim(htmlentities(sanitize_text_field($_POST['mailtype']),ENT_QUOTES));
    $array['host'] = trim(htmlentities(sanitize_text_field($_POST['host']),ENT_QUOTES));
    $array['port'] = trim(htmlentities(sanitize_text_field($_POST['port']),ENT_QUOTES));
    $array['user'] = trim(htmlentities(sanitize_text_field($_POST['user']),ENT_QUOTES));  
    $array['password'] = trim(htmlentities(sanitize_text_field($_POST['password']),ENT_QUOTES));
    $array['femail'] =trim(htmlentities(sanitize_text_field($_POST['femail']),ENT_QUOTES)); 
    $array['subject'] =trim(htmlentities(sanitize_text_field($_POST['subject']),ENT_QUOTES));
    $array['sitekey'] =trim(htmlentities(sanitize_text_field($_POST['sitekey']),ENT_QUOTES)); 
    $array['skey'] =trim(htmlentities(sanitize_text_field($_POST['skey']),ENT_QUOTES)); 
    
    $var = json_encode($array);
    if(empty($check)){
      add_option('smtp_mail_inzone', $var); 
    }else{
      
      update_option('smtp_mail_inzone', $var); 
      
    }
  }
  $get_smtp = json_decode(get_option('smtp_mail_inzone'));
  
  echo '<div class="wrap">';
  echo '<h1>SMTP MAIL Setting</h1>';
  
  echo '<p class="adminbox">This Plugin is supported Google Captcha V2. You can call this form with Shortcode. [zone_smtp_mail] </p>';
  $mwp = $sm = null;
  $mailtype = isset($get_smtp->mailtype)?$get_smtp->mailtype:null;
  $host = isset($get_smtp->host)?$get_smtp->host:null;
  $port =isset($get_smtp->port)?$get_smtp->port:null;
  $user = isset($get_smtp->user)?$get_smtp->user:null;
  $password = isset($get_smtp->password)?$get_smtp->password:null;
  $femail = isset($get_smtp->femail)?$get_smtp->femail:null;
  $subject = isset($get_smtp->subject)?$get_smtp->subject:null;
  $sitekey = isset($get_smtp->sitekey)?$get_smtp->sitekey:null;
  $skey = isset($get_smtp->skey)?$get_smtp->skey:null;
  
  if($mailtype == 'smtp'){$sm = 'selected';}elseif($mailtype == 'wp'){$mwp = 'selected';}
  ?>
  
  <form method="post" action="" id="addsmtp" name="addsmtp">
   <table width="42%" cellpadding="10">
    
     
     <tr>
       <td width="20%" ><b>MAIL :</b> <span class="red" >*</span></td>
       <td width="90%" >
         <select name="mailtype" class="input" id="mailtype" >
          <option value="smtp" <?= $sm?> >SMTP</option>
          <option value="wp" <?= $mwp?>>WP Mail</option>
        </select>
      </td>
      <td> </td>
    </tr>
    
    <tr id="host_h">
     <td><b>Host:</b> <span class="red" >*</span></td>
     <td><input type="text" id="host" name="host" class="input" value="<?= $host; ?>" >
       
      <div></div>
      
      
    </td>
    <td> </td>
  </tr>
  
  
  <tr id="port_h">
   <td><b>Port:</b> <span class="red" >*</span> 
   </td>
   <td><input type="text" id="port"  class="input "   name="port" value="<?= $port; ?>" ></td>
   <td> </td>
 </tr>
 
 <tr id="user_h">
   <td><b>Username:</b> <span class="red" >*</span></td>
   <td><input type="text" id="user"  class="input "   name="user" value="<?= $user; ?>" ></td>
   <td></td>
 </tr>
 <tr id="pass_h">
   <td><b>Password:</b> <span class="red" >*</span></td>
   <td><input type="password" id="password"  class="input "   name="password" value="<?= $password; ?>" > </td>
   <td> </td>
 </tr>
 
 <tr>
   <td><b>To Email:</b> <span class="red" >*</span></td>
   <td><input type="text" id="femail"  class="input "   name="femail" value="<?= $femail; ?>" ></td>
   <td> </td>
 </tr>
 
 <tr>
   <td><b>Subject:</b> <span class="red" >*</span></td>
   <td><input type="text" id="subject"  class="input "    name="subject" value="<?= $subject; ?>" ></td>
   <td> </td>
 </tr>
 
 <tr>
   <td><b>Site Key:</b>  <span class="red" >*</span>
   </td>
   <td><input type="text" id="sitekey"  class="input "    name="sitekey" value="<?= $sitekey; ?>" ></td>
   <td align="left"><div class="tooltip"> help?
    <span class="tooltiptext">This plugin supported recaptcha v2. Create <br><a href="https://developers.google.com/recaptcha/docs/display" target="_blank">Google Captcha</a></span>
  </div></td>
</tr>
<tr>
 <td><b>Secret Key:</b> <span class="red" >*</span> </td>
 <td><input type="text" id="skey"  class="input "   name="skey" value="<?= $skey; ?>" ></td>
 <td> </td>
</tr>

<tr>
 <td> </td>
 <td><input type="submit" name="btnsave" id="btnsave" value="<?php echo __('Save Changes','vertical-news-scroller'); ?>" class="button-primary">&nbsp;&nbsp;<input type="button" name="cancle" id="cancle" value="<?php echo __('Cancel','vertical-news-scroller'); ?>" class="button-primary" onclick="location.href='admin.php?page=Scrollnews-settings'"> </td>
 <td> </td>
</tr>
</table>
</form>

<?php
echo '</div>';


}