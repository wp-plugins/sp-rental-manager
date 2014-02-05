<?php
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