<?php
/*
Plugin Name: The Content Injection
Plugin URI: http://www.ashishdas.com
Description: Puts User Defined Codes Before and After Content of Single Posts.
Version: 2.0
Author: Aashish Das
Author URI: http://www.ashishdas.com
License: GPL
*/
add_option("tc_code_before" , "Sample Codes"  );
add_option("tc_code_after" , "Sample Codes"  );
add_action("admin_menu" , 'wp_admin_options_page');
add_action("the_content" , 'TC_Injection_AfterC');
function wp_admin_options_page(){
add_options_page("TC Injection" , "TC Injection" , "administrator" , "TC-Injection" , "TC_INJECTION_CODES");}
function TC_INJECTION_CODES(){
	$TC_INJECTION_CODES  = "<div id='ES_form'><h2>The Content Injection 1.0 - Admin Panel</h2>" . "</br>" ;
	$TC_INJECTION_CODES .= "<form method='post' action='options.php'>" . wp_nonce_field('update-options');
	$TC_INJECTION_CODES .= "<p>Enter Codes Before : <br> <TEXTAREA rows='20' cols='100' name= 'tc_code_before'/>". get_option(tc_code_before) ."</TEXTAREA></p>" . "<br/>" ;
	$TC_INJECTION_CODES .= "<p>Enter Codes After : <br> <TEXTAREA rows='20' cols='100' name= 'tc_code_after'/>". get_option(tc_code_after) ."</TEXTAREA></p>" . "<br/>" ;
	$TC_INJECTION_CODES .= "<input type='submit' value='Update' /><input type='hidden' name='action' value='update' /><input type='hidden' name='page_options' value='tc_code_before,tc_code_after' /></form></div>"; 
	echo $TC_INJECTION_CODES;}
function TC_Injection_AfterC($content){
    $TC_Injection_Before = get_option(tc_code_before);
	$TC_Injection_After = get_option(tc_code_after);
	if(!is_single()){
		return $content; }else{ return $TC_Injection_Before . $content . $TC_Injection_After;}
	}
?>