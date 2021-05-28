<?php
/*
*Plugin Name: Custome Web Mail Form
*Version: 1.0 | <a href="options-general.php?page=smtp-mail-setting">Settings</a> 
*Description: Send Mail via SMTP and WP mail with WordPress Plugin. Connect with any SMTP,    *ReCaptcha v2 Fix for Form. Please Call form via Shortcode [zone_smtp_mail]. 
*/




//SHORTCODE
function my_shortcode_add(){
  wp_enqueue_style('my-css', plugin_dir_url( __FILE__ ) . 'css/style.css' );
  #wp_enqueue_style('my-css'); //loaded here
  wp_enqueue_script('ajax-handle', plugin_dir_url( __FILE__ ) . 'js/functions.js',  array( 'jquery' ) );
  wp_localize_script('ajax-handle','the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
  
  wp_enqueue_script(
    'validate',
    'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js', 
    array('jquery') 
  );
  wp_enqueue_script(
    'recaptcha',
    'https://www.google.com/recaptcha/api.js', 
    array('jquery') 
  );
  ob_start();
  include("user_face/form.php");
  return ob_get_clean();
}
add_shortcode('zone_smtp_mail', 'my_shortcode_add');

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');




include_once dirname( __FILE__ ) . '/admin/index.php';
include_once dirname( __FILE__ ) . '/user_face/form_submit.php';
