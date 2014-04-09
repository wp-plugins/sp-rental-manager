<?php

function sp_rm_delete_meta($option_name,$id){
	global $wpdb;
	$wpdb->query("DELETE FROM ".$wpdb->prefix . "sp_rm_rentals_meta WHERE post_id = ".$wpdb->escape($id)." and meta_key = '".$option_name."'");	
	
	
}
function sp_rm_get_meta($option_name,$id){
	global $wpdb;
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals_meta where post_id = '".$wpdb->escape($id)."' and meta_key = '".$option_name."'", ARRAY_A);
	if(count($r) > 0){
		return $r[0]['meta_value'];
	}else{
		return false;
	}
}
function sp_rm_update_meta($option_name,$option_value,$post_id,$multi = false){
	global $wpdb;
	
	
	$r_find = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals_meta where post_id = '".$wpdb->escape($post_id)."' and meta_key = '".$option_name."'", ARRAY_A);
	
	if(count($r_find) == 0){
	sp_rm_add_meta($option_name,$option_value,$post_id,$multi);
	}else{
		
	$update['meta_value'] = $option_value;

	
	$where['post_id'] = $post_id;
	$where['meta_key'] = $option_name;
	
	
	$wpdb->update("".$wpdb->prefix . "sp_rm_rentals_meta",$update,$where);
	}
}


function sp_rm_add_meta($option_name,$option_value,$post_id,$multi = false){
	
	global $wpdb;
	
	
	$insert['meta_key'] = $option_name;
	$insert['meta_value'] = $option_value;
	$insert['post_id'] = $post_id;
	
	$wpdb->insert("".$wpdb->prefix . "sp_rm_rentals_meta", $insert);
	
}
function sp_rm_thumbnail($url,$w,$h){
	global $wpdb;
	$params = array('width' => 400, 'height' => $h,'width' => $w, 'crop' => true);

			return bfi_thumb($url, $params);
}



function dlgAdminEmail($subject,$body,$to){
	
	
	
			$admin_emails = explode(",",$to);
			
			$m = new Mail(); // create the mail Karen.Alger@umassmed.edu
			$m->From(get_bloginfo( 'admin_email' ));
			$m->To( $admin_emails);
			$m->Subject($subject );
			$m->Body( $body);
			$m->Send(); // send the mail	
	
}


function sp_rm_redirect($url){
	
echo  '<script type="text/javascript">
<!--
window.location = "'.$url.'"
//-->
</script>';	
	
}




function sp_rm_encrypt($text) 
{ 
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
} 

function sp_rm_decrypt($text) 
{ 
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
} 
?>