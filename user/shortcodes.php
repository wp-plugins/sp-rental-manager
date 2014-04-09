<?php

function sp_rm_check_permalinks(){
	
	
	global $wpdb;

	
	 if ( get_option('permalink_structure') == '' ) { 
	 
	 
	
	 return '&page_id='.$_GET['page_id'].'';
	 
	  } 
	
	
}
function sp_rm_listing_title($id){
	
	global $wpdb, $post_data;
	 
	
	  if ($_GET['listing_id'] != "") {
          $r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$wpdb->escape($_GET['listing_id'])."'", ARRAY_A);	
	
		if($r[0]['unit'] != ''){
		$unit = '#'.$r[0]['unit'].'';	
		}
	
	return ''.$r[0]['address'].' '.$r[0]['address2'].' '.$unit.', '.$r[0]['city'].' '.$r[0]['state'].'';
        } else {
            return $post_data['the_title'];
        }
	
	
	
}
function sp_rm_show_available_listings($atts){
	
	global $wpdb;

	
	
	$content .='<div id="rental_listings">';
	if($_GET['listing_id'] != ""){
		
		
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$wpdb->escape($_GET['listing_id'])."'", ARRAY_A);			
	
		if($r[0]['unit'] != ''){
		$unit = '#'.$r[0]['unit'].'';	
		}
	$content .='
	<div class="sp_rp_bread">
	<span><a href="?listing_id=">Back to Listings</a></span> &raquo; <span>'.$r[0]['address'].' '.$unit .' '.$r[0]['city'].' '.$r[0]['state'].'</span>
	</div>
	<div class="rm_listing_main_img">
	
	
	
	';
		if($r[0]['photo'] == ""){
	
			
			$img = '<img src="'.get_bloginfo("wpurl").'/wp-content/plugins/sp-rental-manager/images/no_house.jpg">';
			
		}else{
			
			if(RM_PREMIUM == 1){
			$content .=sp_rm_display_additiona_images($r[0]['photo'],$r[0]['id']);	
			}else{
		$img = '<div id="sp_rm_gallery">
	
		<div id="sp_rm_gallery_main" >
		<img src="'.sp_rm_thumbnail($r[0]['photo'],get_option('sp_rm_list_thumb_size_w'), get_option('sp_rm_list_thumb_size_h')).'" >
		</div>
		</div>';	
			}
		}
	
				$content .='</div>

	'.$img .'
	<div class="sp_rp_bread">Details and Features</div>
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>

	</thead><tbody>
	

	<tr>
	<td><strong>'.__("Price","sp-rm").'</strong>:</td>
	<td>'.$r[0]['price'].'</td>
	</tr>';
	
	if($r[0]['description'] != ""){
	$content .='<tr>
	<td><strong>'.__("Description","sp-rm").'</strong>:</td>
	<td>'.stripslashes($r[0]['description']).'</td>
	</tr>';	
		
	}
	$features = unserialize($r[0]['features']);
	$features_values = unserialize($r[0]['features_values']);

	$i= 0;
	if($features[0] != ""){
		
		$content .='<tr>
	<td><strong>'.__("Features","sp-rm").'</strong>:</td>
	<td><table>';	
		
	
	foreach( $features as $key => $value){
	
		
		$content .='<tr><td style="width:150px"><strong>'.stripslashes($features[$i]).':</strong> </td><td>'.stripslashes($features_values[$i]).'</td></tr>';
			$i++;
	}
	$content .='</table></td></tr>';
	}
	
	
	$content .='
	<tr>
	<td></td>
	<td>';
	if(get_option('sprm_download_application') != ''){
	$content .='<a class="button" style="margin-left:20px" href="'.get_option('sprm_download_application').'" target="_blank">'.__("Download Application","sp-rm").'</a>';	
	}else{
	$content .='<a class="button" style="margin-left:20px" href="'.get_option('sp_rm_application_link').'?listing_id='.$r[0]['id'].''.sp_rm_check_permalinks().'">'.__("Submit An Application","sp-rm").'</a>';
	}
	
	$content .='</td>
	
	</tr>
	
	
	
	</tbody></table>';
	  if(RM_PREMIUM == 1){
		  if(sp_rm_get_meta('rental_lat',$r[0]['id']) != '' && sp_rm_get_meta('rental_lon',$r[0]['id']) != ''){
		 $geo = ''.sp_rm_get_meta('rental_lat',$r[0]['id']).','.sp_rm_get_meta('rental_lon',$r[0]['id']).'';
		  }else{
			$geo = false;  
		  }
		  
		  $content .='
	<div id="sm_rm_gmaps">
		
	'. sp_rm_display_google_map(''.$r[0]['address'].' #'.$r[0]['unit'].' '.$r[0]['city'].' '.$r[0]['state'].'',$geo ).'
	</div>
	
	';	
	  }
	
	
	
	
	
	
		
		
	}else{
	
	
	
	if(isset($atts['development'])){
	$dev = $atts['development'];
	}
	
	if($dev != ""){
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where did = '".$dev."' and status = 0", ARRAY_A);			
	}else{
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals  where  status = 0 order by did,name", ARRAY_A);				
	}
	
	
	
	
				$listings_template .='

	
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>

<th colspan="2" >'.__("Address","sp-rm").'</th>
<th >'.__("Rent","sp-rm").'</th>
<th ></th>
</tr>
	</thead><tbody>';	
	
	for($i=0; $i<count($r); $i++){
		
		
		if($r[$i]['photo'] == ""){
			
			$img = '<a  href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'"><img width="75" src="'.get_bloginfo("wpurl").'/wp-content/plugins/sp-rental-manager/images/no_house.jpg"></a>';
		}else{
		$img = '<a  href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'"><img width="75" src="'.sp_rm_thumbnail($r[$i]['photo'],get_option('sp_rm_list_thumb_size_w'), get_option('sp_rm_list_thumb_size_h')).'"></a>';	
			
		}
		
		if(get_option('sprm_download_application') != ''){
		$app = 	get_option('sprm_download_application');
		}else{
		$app = 	''.get_option('sp_rm_application_link').'?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'';	
		}
		$listings_template .='<tr>
		<td>'.	$img .'</td>
		<td><a href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'">'.$r[$i]['address'].''.$r[$i]['address2'].'  '.$r[$i]['unit'].', '.$r[$i]['city'].' '.$r[$i]['state'].'</a></td>
	<td>'.$r[$i]['price'].'</td>
	
		<td>
	<a class="button" style="margin-left:20px" href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'">'.__("View","sp-rm").'</a>
	<a class="button" style="margin-left:20px" href="'.$app .'">'.__("Apply","sp-rm").'</a>
	 </td>
		</tr>';
		
				}
				
				$listings_template .= '</tbody></table>
				
	
				
				';
				
				
		$listings_template = apply_filters('sp_rm_listings_template',$listings_template, $r,$atts);
		$content .=$listings_template;
	}
	$content .='</div>';
	return $content;
}
 if ($_GET['listing_id'] != "") {
add_filter('wp_title', 'sp_rm_listing_title');

 }
add_shortcode( 'rental_listing', 'sp_rm_show_available_listings' );
?>