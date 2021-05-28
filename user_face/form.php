<?php
 
  
   
    
$get_smtp = json_decode(get_option('smtp_mail_inzone'));
$sitekey = isset($get_smtp->sitekey)?$get_smtp->sitekey:'6Leife0aAAAAAOAQ41M3caYhr11mKhyukdeSB-Gh';
?>
<form id="myform" method="post" novalidate class="needs-validation needs-focus was-validated">
  <div class="field-group name ">
    <label for="sform-name">Name<span class="">∗</span></label>
    <div class="is-invalid">
      <input type="text" id="sformname" name="sformname" class="form-control " value="" placeholder="" required>
    </div>
  </div>
  <div class="field-group email half ">
    <label for="sform-email">Email<span class="">∗</span></label>
    <div class="is-invalid">
      <input type="email" name="sformemail" id="sformemail" class="form-control" value="" placeholder="" required>
    </div>
  </div>
  <div class="field-group phone half ">
    <label for="sform-phone">Phone <span class="">∗</span></label>
    <div class="">
      <input type="tel" id="sformphone" name="sformphone" class="form-control " value="" placeholder="">
    </div>
  </div>
  <div class="field-group ">
    <label for="sform-message">Message<span>∗</span></label>
    <div class="">
      <textarea name="sformmessage" id="sformmessage" rows="10" type="textarea" class="form-control" required placeholder=""></textarea>
    </div>
  </div>
  <br>
  <div class="field-group " id="captcha-container">
    <div class="g-recaptcha" data-sitekey="<?php echo $sitekey; ?>"></div>
  </div>
  
  
  
  
  <div id="sform-submit-wrap" class="">
    <button name="submission" id="formsubmit" type="submit">Submit</button>
    <button name="submission" id="formsubmit" type="reset">Reset</button>
  </div>
  <div id="loading"><img src="<?php echo plugin_dir_url( __FILE__ ) . '../images/loading.gif'; ?>"> Loading ...</div>
  <div id="sform-success" class="displaynone"><span tabindex="-1" class="message visible">Your Message Successfully Delivered. Thanks!</span> </div>
  <div id="sform-error" class="displaynone"><span tabindex="-1" class="message visible">Please Try Again Some Error. Sorry!</span> </div>
</form>