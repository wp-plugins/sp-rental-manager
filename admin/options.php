<?php
if (!function_exists('SpRmNavigationMenu')) {
function SpRmNavigationMenu(){
	
$menu = '<div style="padding:10px 10px 30px 10px">
  <a class="button" href="admin.php?page=SpRm">'.__("Edit Options","sp-rm").'</a>
<a class="button" href="admin.php?page=sp-rm-applications">'.__("Applications","sp-rm").'</a>
<a class="button" href="admin.php?page=sp-rm-developments">'.__("Listing","sp-rm").'</a>
  </div> ';	
	
	return $menu;
}
function SpRmOptionsPage(){
	
	
	global $wpdb;
	
	
	if($_GET['save_mmis'] == 1){
		

		
		update_option( 'sp_rm_application_link',esc_html($_POST['sp_rm_application_link']) ); 
		update_option( 'sp_rm_application_ty',esc_html($_POST['sp_rm_application_ty']) ); 
		update_option( 'sp_rm_application_emails',esc_html($_POST['sp_rm_application_emails']) ); 
		
		
		  if(RM_PREMIUM == 1){
			  update_option( 'sp_rm_gmap_api',esc_html($_POST['sp_rm_gmap_api']) ); 
			   update_option( 'sp_rm_gmap_width',esc_html($_POST['sp_rm_gmap_width']) ); 
			    update_option( 'sp_rm_gmap_height',esc_html($_POST['sp_rm_gmap_height']) ); 
				 update_option( 'sp_rm_gmap_zoom',esc_html($_POST['sp_rm_gmap_zoom']) ); 
			
		  }
				if($_POST['dlgrl_enable_ssn'] == "1"){					
					update_option('dlgrl_enable_ssn','1' ); 
				}else{
					update_option('dlgrl_enable_ssn','0' ); 
				}
			
			
	}
	
	
	
	if(get_option('dlgrl_enable_ssn') == 1){
	 $enablessn = ' checked="checked" ';	
	}else{
		 $enablessn = '  ';
	}
	
	$content .=''. SpRmNavigationMenu().'<h1>SP Rental manager Options</h1>';

	//premium upgrade
	if($_POST['upgrade'] != ""){
	
	
	$mydir = ''.ABSPATH.'wp-content/plugins/sp-rental-manager/premium/'; 
	if (is_dir($mydir)){
	$d = dir($mydir); 
	while($entry = $d->read()) { 
	 if ($entry!= "." && $entry!= "..") { 
	 @unlink($entry); 
	 } 
	} 
	$d->close(); 
	@rmdir($mydir); 
	}
	function _return_direct() { return 'direct'; }
add_filter('filesystem_method', '_return_direct');
WP_Filesystem();
remove_filter('filesystem_method', '_return_direct');
	
	global $wp_filesystem;	
	echo  unzip_file( $_FILES['premium']['tmp_name'],''.ABSPATH.'wp-content/plugins/sp-rental-manager/' );	
	echo '<script type="text/javascript">
<!--
window.location = "admin.php?page=SpRm&cdm-upgrade=1"
//-->
</script>';
	
	
	}
	
	$content .='
<div style="border:1px solid #CCC;padding:5px;margin:5px;background-color:#e3f1d4;">';

if(RM_PREMIUM != 1){

$content .='<h3>Upgrade to premium!</h3>
<p>If you would like to see the extra features and upgrade to premium please purchase the addon package by <a href="http://smartypantsplugins.com/sp-rental-manager-plugin/" target="_blank">clicking here</a>. Once purchased you will receive a file, upload that file here and the plugin will do the rest!</p>';
}else{
$content .='<h3>Thanks for upgrading!</h3>
<p>You can patch the premium version with the upload form below once new versions become available!</p>';
}
	$content .='
<form action="admin.php?page=SpRm&" method="post" enctype="multipart/form-data">
<input type="file" name="premium"> <input type="submit" name="upgrade" value="Install Premium!">
</form>

</div>';
//premium upgrade

	$content .='<h2>Settings</h2><form action="admin.php?page=SpRm&save_mmis=1" method="post">
	 <table class="wp-list-table widefat fixed posts" cellspacing="0">
  
   
         <tr>
    <td width="300"><strong>'.__("Application full url","sp-rm").'</strong><br><em>'.__("This is the full url to your applications page which is needed to redirect users who are applying for the application. Please put the shortcode [sp_rm_listing_applications] on the page.","sp-rm").'</td>
    <td><input type="text" name="sp_rm_application_link"  value="'.get_option('sp_rm_application_link').'"  size=80"> </td>
  </tr>
       <tr>
    <td width="300"><strong>'.__("Thank you page","sp-rm").'</strong><br><em>'.__("Full url for the thank you page after the user submits an app.","sp-rm").'</em></td>
    <td><input type="text" name="sp_rm_application_ty"  value="'.get_option('sp_rm_application_ty').'"  size=80"> </td>
  </tr>
    <tr>
    <td width="300"><strong>'.__("Emails","sp-rm").'</strong><br><em>'.__("This is where you want the submitted application to go, comma seperate for multiple emails.","sp-rm").'</em></td>
    <td><input type="text" name="sp_rm_application_emails"  value="'.get_option('sp_rm_application_emails').'"  size=80"> </td>
  </tr>
     <tr>
    <td width="300"><strong>'.__("Enable SSN?","sp-rm").'</strong><br><em>'.__("Would you like to take the users social security number? Please only use this features if you are using an SSL Certificate as you are responsibile for your own data. The SSN is encrypted into the database using  advanced binary encryption methods.","sp-rm").'</em></td>
    <td><input type="checkbox" name="dlgrl_enable_ssn"   value="1" '. $enablessn.'> </td>
  </tr>
  
    <tr>
    <td width="300"><strong>'.__("Disclaimer","sp-rm").'</strong><br><em>'.__("This is the disclaimer on the application (legal terms)","sp-rm").'</em></td>
    <td><textarea style="width:100%;height:100px" name="sp_rm_application_disclaimer" >'.stripslashes(get_option('sp_rm_application_disclaimer')).'</textarea> </td>
  </tr>';
  
  if(RM_PREMIUM == 1){
	  
	
	
	$content .='  <tr>
    <td width="300"><strong>'.__("Google Maps API Key","sp-rm").'</strong><br><em>'.__("Use this funciton only if you want to integrate google maps into your posts. Remove it to disable google maps!","sp-rm").' </em></td>
    <td><input type="text" name="sp_rm_gmap_api"  value="'.get_option('sp_rm_gmap_api').'"  size=80"> <a href="https://code.google.com/apis/console/" target="_blank">Click here to get a key</a></td>
  </tr>
  <tr>
    <td width="300"><strong>'.__("Google Map Size","sp-rm").'</strong><br><em>'.__("This is the settings for the map size of the goolge map box,numbers only. Sizes are in pixels.","sp-rm").' </em></td>
    <td>Width: <input type="text" name="sp_rm_gmap_width"  value="'.get_option('sp_rm_gmap_width').'"  size=10">px <br>height: <input type="text" name="sp_rm_gmap_height"  value="'.get_option('sp_rm_gmap_height').'"  size=10">px <br> Zoom: <input type="text" name="sp_rm_gmap_zoom"  value="'.get_option('sp_rm_gmap_zoom').'"  size=10"> Zoom levels between 0 (the lowest zoom level, in which the entire world can be seen on one map) to 21+ (down to individual buildings) </td>
  </tr>
  
  ';  
	  
  }
  
  
  $content .='
    <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="save_options" value="'.__("Save Options","sp-rm").'"></td>
  </tr>
</table>
</form>
	
	';
	
	
	
	echo $content;
}
}
?>