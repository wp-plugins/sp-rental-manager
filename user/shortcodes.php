<?php

function sp_rm_check_permalinks(){
	
	
	global $wpdb;

	
	 if ( get_option('permalink_structure') == '' ) { 
	 
	 
	
	 return '&page_id='.$_GET['page_id'].'';
	 
	  } 
	
	
}

function sp_rm_show_available_listings($atts){
	
	global $wpdb;

	
	
	$content .='<div id="rental_listings">';
	if($_GET['listing_id'] != ""){
		
		
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$wpdb->escape($_GET['listing_id'])."'", ARRAY_A);			
	
	
	$content .='<div class="rm_listing_main_img">';
		if($r[0]['photo'] == ""){
			
			$img = '<img src="'.get_bloginfo("wpurl").'/wp-content/plugins/sp-rental-manager/images/no_house.jpg">';
			
		}else{
			
			if(RM_PREMIUM == 1){
			$content .=sp_rm_display_additiona_images($r[0]['photo'],$r[0]['id']);	
			}else{
		$img = '<img src="'.content_url().'/plugins/sp-rental-manager/thumbs.php?src='.$r[0]['photo'].'&w='.get_option('sp_rm_list_thumb_size_w').'&h='.get_option('sp_rm_list_thumb_size_h').'&zc=3" >';	
			}
		}
	
				$content .='</div>
<p>'.$r[0]['address'].' #'.$r[0]['unit'].', '.$r[0]['city'].' '.$r[0]['state'].'</p>
	'.$img .'
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>

<th colspan="2" >'.__("Listing","sp-rm").' #'.$r[0]['id'].'</th>

</tr>
	</thead><tbody>
	
	<tr>
	<td>'.__("Address","sp-rm").':</td>
	<td>'.$r[0]['address'].' #'.$r[0]['unit'].'<br>'.$r[0]['city'].' '.$r[0]['state'].'</td>
	</tr>
	<tr>
	<td>'.__("Price","sp-rm").':</td>
	<td>'.$r[0]['price'].'</td>
	</tr>';
	
	if($r[0]['description'] != ""){
	$content .='<tr>
	<td>'.__("Description","sp-rm").':</td>
	<td>'.stripslashes($r[0]['description']).'</td>
	</tr>';	
		
	}
	$features = unserialize($r[0]['features']);
	$features_values = unserialize($r[0]['features_values']);

	$i= 0;
	if($features[0] != ""){
		
		$content .='<tr>
	<td>'.__("Features","sp-rm").':</td>
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
	<td><a class="button" style="margin-left:20px" href="'.get_option('sp_rm_application_link').'?listing_id='.$r[0]['id'].''.sp_rm_check_permalinks().'">'.__("Submit An Application","sp-rm").'</a></td>
	</tr>
	
	
	
	</tbody></table>';
	  if(RM_PREMIUM == 1){
		  $content .='
	<div id="sm_rm_gmaps">
	
	'. sp_rm_display_google_map(''.$r[0]['address'].' #'.$r[0]['unit'].' '.$r[0]['city'].' '.$r[0]['state'].'').'
	</div>
	
	';	
	  }
	
	
	
	
	
	
		
		
	}else{
	
	
	
	
	$dev = $atts['development'];
	
	
	if($dev != ""){
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where did = '".$dev."'", ARRAY_A);			
	}else{
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals order by did,name", ARRAY_A);				
	}
	
	
				$content .='

	
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
		$img = '<a  href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'"><img width="75" src="'.content_url().'/plugins/sp-rental-manager/thumbs.php?src='.$r[$i]['photo'].'&w='.get_option('sp_rm_thumb_size_w').'&h='.get_option('sp_rm_thumb_size_h').'"></a>';	
			
		}
		$content .='<tr>
		<td>'.	$img .'</td>
		<td><a href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'">'.$r[$i]['address'].'  '.$r[$i]['unit'].', '.$r[$i]['city'].' '.$r[$i]['state'].'</a></td>
	<td>'.$r[$i]['price'].'</td>
	
		<td>
	<a class="button" style="margin-left:20px" href="?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'">'.__("View","sp-rm").'</a>
	<a class="button" style="margin-left:20px" href="'.get_option('sp_rm_application_link').'?listing_id='.$r[$i]['id'].''.sp_rm_check_permalinks().'">'.__("Apply","sp-rm").'</a>
	 </td>
		</tr>';
		
				}
				
				$content .= '</tbody></table>
				
	
				
				';
	}
	$content .='</div>';
	return $content;
}
add_shortcode( 'rental_listing', 'sp_rm_show_available_listings' );
?>