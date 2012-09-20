<?php
if (!function_exists('SpRmNavigationMenu')) {
function SpRmNavigationMenu(){
	
	
if($_GET['sp_rm_hidemessage'] == 1){
	
$content .='		
			<script type="text/javascript">
				jQuery(document).ready( function() {
				 sp_cu_dialog("#sp_rm_cdm_ignore",400,200);
			 
				});
			</script>

			<div style="display:none">
			
			<div id="sp_rm_cdm_ignore">
			<h2>It\'s OK!</h2>
			<p>Hey no hard feelings, we hate nag messages too! If you change your mind and want to give us some love checkout the settings page for a link to the our website!</p>
			</div>
		    </div>';	
			update_option("sp_rm_cdm_ignore",1);
}

if($_GET['sp_rm_hidemessage'] == '2'){
	
update_option("sp_rm_cdm_ignore",0);	
}
if(RM_PREMIUM != 1 && get_option("sp_rm_cdm_ignore") != 1){
	
	$content .='	
	<div style="border:1px solid #CCC;padding:5px;margin:5px;background-color:#eaf0ea; border-radius:10px">
	<p><strong>Upgrade to the premium version today to get enhanced features and support. Features include: Multiple photos for listings,export all users of a property,google maps integration!</strong> <br />
<br />
<a href="http://smartypantsplugins.com/sp-rental-manager-plugin/" target="_blank" class="button">Click here to upgrade! </a>  <a style="margin-left:10px" href="http://smartypantsplugins.com/donate/" target="_blank" class="button">Click here to donate</a> <a href="admin.php?page=SpRm&sp_rm_hidemessage=1"  class="button" style="margin-left:10px">Click here to ignore us!</a></p>
	</div>';

}

	
	
$content .='	<div style="padding:10px 10px 30px 10px">
  <a class="button" href="admin.php?page=SpRm">'.__("Edit Options","sp-rm").'</a>
<a class="button" href="admin.php?page=sp-rm-applications">'.__("Applications","sp-rm").'</a>
<a class="button" href="admin.php?page=sp-rm-developments">'.__("Listing","sp-rm").'</a>
  </div> ';	
	
	return $content;
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
	
	$content .='<h1>Options Page</h1>'. SpRmNavigationMenu().'';

	
	


	$content .='<h2>Settings</h2>
	';
	if(RM_PREMIUM != 1 && get_option("sp_rm_cdm_ignore") == 1){
	
	$content .='	
	<div style="border:1px solid #CCC;padding:5px;margin:5px;background-color:#eaf0ea; border-radius:10px">
	<p><strong>Upgrade to the premium version today to get enhanced features and support. Features include: Multiple photos for listings,export all users of a property,google maps integration!</strong> <br />
<br />
<a href="http://smartypantsplugins.com/sp-rental-manager-plugin/" target="_blank" class="button">Click here to upgrade! </a>  <a style="margin-left:10px" href="http://smartypantsplugins.com/donate/" target="_blank" class="button">Click here to donate</a> </p>
	</div>';

}

	$content .='
	
	<form action="admin.php?page=SpRm&save_mmis=1" method="post">
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