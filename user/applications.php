<?php



function SpRmViewApplications(){
	
	global $wpdb;
	
	
	


}


function SpRmApplicationHTML($id){
global $wpdb;



$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications where id = '".$id."'", ARRAY_A);		
	$rental = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$r[0]['property']."'", ARRAY_A);		
	
	$address1 = unserialize($r[0]['address1']);
	$address2 = unserialize($r[0]['address2']);
	$ref1 = unserialize($r[0]['ref1']);
	$ref2 = unserialize($r[0]['ref2']);
	$employ1 = unserialize($r[0]['employ1']);
	$employ2 = unserialize($r[0]['employ2']);
	$rel1 = unserialize($r[0]['rel1']);
	
	
	$content = '	
	<h1>'.__("Application for","sp-rm").': '.stripslashes($r[0]['name']).'</h1>
	<div id="rental_listings">

  <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Property Interested In:</strong></td>
    <td colspan="3">'.$rental[0]['address'].' #'.$rental[0]['unit'].', '.$rental[0]['city'].' '.$rental[0]['state'].'</td>
 
 </tr>
  <tr>
    <td><strong>Name:</strong></td>
    <td>'.stripslashes($r[0]['name']).'</td>
	 <td><strong>SSN#</strong></td>
    <td>'.sp_rm_decrypt($r[0]['s']).'</td>
  </tr>
  <tr>
    <td><strong>Date of Birth:</strong></td>
    <td>'.stripslashes($r[0]['dob']).'</td>
	 <td><strong>Home phone</strong></td>
    <td>'.stripslashes($r[0]['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Cell:</strong></td>
    <td>'.stripslashes($r[0]['cell']).'</td>
	 <td><strong>Name and ages of children</strong></td>
    <td>'.stripslashes($r[0]['children']).'</td>
  </tr>
</table>
<h2>Personal History</h2>
 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Present Address:</strong></td>
    <td>'.stripslashes($address1['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($address1['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Landlord Name:</strong></td>
    <td>'.stripslashes($address1['landlord']).'</td>
	 <td><strong>Phone:</strong></td>
    <td>'.stripslashes($address1['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Monthly Rent:</strong></td>
    <td>'.stripslashes($address1['rent']).'</td>
	 <td><strong>Dates:</strong></td>
    <td>From '.stripslashes($address1['from']).' To '.stripslashes($address1['to']).'</td>
  </tr>
</table>
<br>
<table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Previous Address:</strong></td>
    <td>'.stripslashes($address2['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($address2['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Landlord Name:</strong></td>
    <td>'.stripslashes($address2['landlord']).'</td>
	 <td><strong>Phone:</strong></td>
    <td>'.stripslashes($address2['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Monthly Rent:</strong></td>
    <td>'.stripslashes($address2['rent']).'</td>
	 <td><strong>Dates:</strong></td>
    <td><strong>From</strong> '.stripslashes($address2['from']).' <strong>To</strong> '.stripslashes($address2['to']).'</td>
  </tr>
</table>
<h2>Employment History</h2>

	 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Present Employer:</strong></td>
    <td>'.stripslashes($employ1['name']).'</td>
	 <td><strong>Position:</strong></td>
  <td>'.stripslashes($employ1['position']).'</td>
  </tr>
    <tr>
    <td><strong>Address:</strong></td>
    <td>'.stripslashes($employ1['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($employ1['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Supervisor\'s Name:</strong></td>
     <td>'.stripslashes($employ1['supervisor']).'</td>
	 <td><strong>Phone:</strong></td>
    <td>'.stripslashes($employ1['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Gross Salary:</strong></td>
    <td>'.stripslashes($employ1['salary']).'</td>
	<td><strong>Dates:</strong></td>
    <td><strong>From </strong>'.stripslashes($employ1['from']).' <strong> To</strong> '.stripslashes($employ1['to']).'</td>
  </tr>
</table>

<br>
		
 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Previous Employer:</strong></td>
    <td>'.stripslashes($employ2['name']).'</td>
	 <td><strong>Position:</strong></td>
  <td>'.stripslashes($employ2['position']).'</td>
  </tr>
    <tr>
    <td><strong>Address:</strong></td>
    <td>'.stripslashes($employ2['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($employ2['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Supervisor\'s Name:</strong></td>
     <td>'.stripslashes($employ2['supervisor']).'</td>
	 <td><strong>Phone:</strong></td>
    <td>'.stripslashes($employ2['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Gross Salary:</strong></td>
    <td>'.stripslashes($employ2['salary']).'</td>
	<td><strong>Dates:</strong></td>
    <td>From '.stripslashes($employ2['from']).' To '.stripslashes($employ2['to']).'</td>
  </tr>
</table>
<h2>Reference</h2>
<p><strong>Please list personal references: (Not Relatives)</strong></p>
	 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Name:</strong></td>
    <td>'.stripslashes($ref1['name']).'</td>
	 <td><strong>Phone:</strong></td>
  <td>'.stripslashes($ref1['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Address:</strong></td>
    <td>'.stripslashes($ref1['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($ref1['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Years Acquainted:</strong></td>
     <td>'.stripslashes($ref1['years']).'</td>
	 
  </tr>

</table>
<br>
 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Name:</strong></td>
    <td>'.stripslashes($ref2['name']).'</td>
	 <td><strong>Phone:</strong></td>
  <td>'.stripslashes($ref2['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Address:</strong></td>
    <td>'.stripslashes($ref2['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($ref2['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Years Acquainted:</strong></td>
     <td>'.stripslashes($ref2['years']).'</td>
	 
  </tr>

</table>
<h2>Nearest Relative</h2>
	 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Name:</strong></td>
    <td>'.stripslashes($rel1['name']).'</td>
	 <td><strong>Phone:</strong></td>
  <td>'.stripslashes($rel1['phone']).'</td>
  </tr>
    <tr>
    <td><strong>Address:</strong></td>
    <td>'.stripslashes($rel1['address']).'</td>
	 <td><strong>City/State/Zip</strong></td>
    <td>'.stripslashes($ref1['csz']).'</td>
  </tr>
  <tr>
    <td><strong>Relationship:</strong></td>
     <td>'.stripslashes($rel1['relationship']).'</td>
	 
  </tr>

</table>
<p><b>'.stripslashes(get_option('sp_rm_application_disclaimer')).'</b></p>

 <table class="wp-list-table widefat fixed posts" cellpadding="4" cellspacing="0" width="80%" border="1" bordercolor="#CCC" >
  <tr>
    <td><strong>Type your initials:</strong></td>
    <td>'.stripslashes($r[0]['sign']).'</td>
	 <td>'.date("l F jS Y",strtotime($r[0]['date'])).'</td>
  <td></td>
  </tr>

</table></div>';	
	
	return $content;
}
function SpRmApplicationForm(){
	
	global $wpdb,$current_user;

		

	if($_POST['submit-app'] != ""){

	
	$i['name'] = $_POST['applicant-name'];
	$i['s'] =  sp_rm_encrypt($_POST['ssn']);
	$i['dob'] = $_POST['dob'];
	$i['phone'] = $_POST['phone'];
	$i['cell'] = $_POST['cell'];	
	$i['children'] = $_POST['children'];	
	$i['address1'] = serialize($_POST['address1']);	
	$i['address2'] = serialize($_POST['address2']);	
	$i['employ1'] = serialize($_POST['employ1']);
	$i['employ2'] = serialize($_POST['employ2']);
	$i['ref1'] = serialize($_POST['ref1']);	
	$i['ref2'] = serialize($_POST['ref2']);
	$i['rel1'] = serialize($_POST['rel1']);	
	$i['date'] = date("Y-m-d");
	$i['property'] = $_POST['rental-property'];
	$i['sign'] = $_POST['sign'];

	$wpdb->insert(  ''.$wpdb->prefix .'sp_rm_applications',$i );
	
	
	
	$body = SpRmApplicationHTML($wpdb->insert_id);
	
	 dlgAdminEmail(''.__("New Rental Application","sp-rm").'',$body,get_option('sp_rm_application_emails'));
	
	sp_rm_redirect(get_option('sp_rm_application_ty'));
	
	}
	
	global $wpdb;
	
	
	
	if($_GET['listing_id'] != ""){
		
		
			$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$wpdb->escape($_GET['listing_id']) ."'", ARRAY_A);	
			
			$rental = '  <tr>
    <td>'.__("Property Interested In","sp-rm").'</td>
    <td colspan="3"><input type="hidden" name="property"  value="'.$_GET['listing_id'].'"> '.$r[0]['address'].' #'.$r[0]['unit'].', '.$r[0]['city'].' '.$r[0]['state'].'</td>
 
 </tr>';		
		
	}else{
		$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals  where status = 0 order by did,name", ARRAY_A);
		
		$rental .= '  <tr>
    <td>'.__("Property Interested In","sp-rm").':</td>
    <td colspan="3"><select name="rental-property" class="required"><option value="">'.__("Select a property","sp-rm").'</option>';
 

		
		for($i=0; $i<count($r); $i++){
			
			$re[$i] = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_developments where id = '".$r[$i]['did']."'", ARRAY_A);
			
			if($re[$i][0]['name'] == ""){
				$rep = '';
			}else{
				$rep = ''.$re[$i][0]['name'] .': ';
			}
			
			
			
			$rental .= '<option value=" '.$r[$i]['id'].'">'.$rep.''.$r[$i]['address'].' #'.$r[$i]['unit'].', '.$r[$i]['city'].' '.$r[$i]['state'].'</option>';
		}
		
		
		$rental .='</td></tr>';
	
	}
	
		$content .='
				<script type="text/javascript">


jQuery().ready(function() {


	// validate signup form on keyup and submit
	jQuery("#abstractForm").validate();

	
jQuery("#abstractForm").submit(function() {
	
superConfirmMaster("#abstractForm");
return false;
	
});

});
</script><div id="rental_listings">
	<form action="?submit-app=1'.sp_rm_check_permalinks().'" method="post" id="abstractForm">	
		<h2>Renter Information</h2>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
'.	$rental.'
  <tr>
    <td>Name:</td>
    <td><input type="text" name="applicant-name" class="required"></td>
	 
	 ';
	 
	 if(get_option('dlgrl_enable_ssn')  == 1){
	 $content .='<td>SSN#</td>
    <td><input type="text" name="ssn" class="required"></td>
  ';
	 }else{
	 $content .='<td></td>
    <td></td>
  ';	 
	 }
  $content .='</tr>
  <tr>
    <td>Date of Birth:</td>
    <td><input type="text" name="dob" class="required"></td>
	 <td>Home phone</td>
    <td><input type="text" name="phone" class="required"></td>
  </tr>
    <tr>
    <td>Cell:</td>
    <td><input type="text" name="cell" class="required"></td>
	 <td>Name and ages of children</td>
    <td><input type="text" name="children" class="required"></td>
  </tr>
</table>
<h2>Personal History</h2>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Present Address:</td>
    <td><input type="text" name="address1[address]" class="required"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="address1[csz]" class="required"></td>
  </tr>
  <tr>
    <td>Landlord Name:</td>
    <td><input type="text" name="address1[landlord]" class="required"></td>
	 <td>Phone:</td>
    <td><input type="text" name="address1[phone]" class="required"></td>
  </tr>
    <tr>
    <td>Monthly Rent:</td>
    <td><input type="text" name="address1[rent]" class="required"></td>
	 <td>Dates:</td>
    <td>From <input type="text" name="address1[from]" size="10" class="required"><br />
To <input class="required" type="text" name="address1[to]" size="10"></td>
  </tr>
</table>
<br>


		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Previous Address:</td>
    <td><input type="text" name="address2[address]"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="address2[csz]"></td>
  </tr>
  <tr>
    <td>Landlord Name:</td>
    <td><input type="text" name="address2[landlord]"></td>
	 <td>Phone:</td>
    <td><input type="text" name="address2[phone]"></td>
  </tr>
    <tr>
    <td>Monthly Rent:</td>
    <td><input type="text" name="address2[rent]"></td>
	 <td>Dates:</td>
    <td>From <input type="text" name="address2[from]" size="10"> <br />
To <input type="text" name="address2[to]" size="10"></td>
  </tr>
</table>
<h2>Employment History</h2>

		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Present Employer:</td>
    <td><input type="text" name="employ1[name]" class="required"></td>
	 <td>Position:</td>
  <td><input type="text" name="employ1[position]" class="required"></td>
  </tr>
    <tr>
    <td>Address:</td>
    <td><input type="text" name="employ1[address]" class="required"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="employ1[csz]" class="required"></td>
  </tr>
  <tr>
    <td>Supervisor\'s Name:</td>
     <td><input type="text" name="employ1[supervisor]" class="required"></td>
	 <td>Phone:</td>
    <td><input type="text" name="employ1[phone]" class="required"></td>
  </tr>
    <tr>
    <td>Gross Salary:</td>
    <td><input type="text" name="employ1[salary]" class="required"></td>
	<td>Dates:</td>
    <td>From <input type="text" name="employ1[from]" size="10" class="required"> <br />
To <input class="required" type="text" name="employ1[to]" size="10"></td>
  </tr>
</table>

<br>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Previous Employer:</td>
    <td><input type="text" name="employ2[name]"></td>
	 <td>Position:</td>
  <td><input type="text" name="employ2[position]"></td>
  </tr>
    <tr>
    <td>Address:</td>
    <td><input type="text" name="employ2[address]"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="employ2[csz]"></td>
  </tr>
  <tr>
    <td>Supervisor\'s Name:</td>
     <td><input type="text" name="employ2[supervisor]"></td>
	 <td>Phone:</td>
    <td><input type="text" name="employ2[phone]"></td>
  </tr>
    <tr>
    <td>Gross Salary:</td>
    <td><input type="text" name="employ2[salary]"></td>
	<td>Dates:</td>
    <td>From <input type="text" name="employ2[from]" size="10"> <br />
To <input type="text" name="employ2[to]" size="10"></td>
  </tr>
</table>
<h2>Reference</h2>
<p>Please list persoonal references: (Not Relatives)</p>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Name:</td>
    <td><input type="text" name="ref1[name]" class="required"></td>
	 <td>Phone:</td>
  <td><input type="text" name="ref1[phone]" class="required"></td>
  </tr>
    <tr>
    <td>Address:</td>
    <td><input type="text" name="ref1[address]" class="required"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="ref1[csz]" class="required"></td>
  </tr>
  <tr>
    <td>Years Acquainted:</td>
     <td><input type="text" name="ref1[years]" class="required"></td>
	 
  </tr>

</table>
<br>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Name:</td>
    <td><input type="text" name="ref2[name]" class="required"></td>
	 <td>Phone:</td>
  <td><input type="text" name="ref2[phone]" class="required"></td>
  </tr>
    <tr>
    <td>Address:</td>
    <td><input type="text" name="ref2[address]" class="required"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="ref2[csz]" class="required"></td>
  </tr>
  <tr>
    <td>Years Acquainted:</td>
     <td><input type="text" name="ref2[years]" class="required"></td>
	 
  </tr>

</table>
<h2>Nearest Relative</h2>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Name:</td>
    <td><input type="text" name="rel1[name]" class="required"></td>
	 <td>Phone:</td>
  <td><input type="text" name="rel1[phone]" class="required"></td>
  </tr>
    <tr>
    <td>Address:</td>
    <td><input type="text" name="rel1[address]" class="required"></td>
	 <td>City/State/Zip</td>
    <td><input type="text" name="rel1[csz]" class="required"></td>
  </tr>
  <tr>
    <td>Relationship:</td>
     <td><input type="text" name="rel1[relationship]" class="required"></td>
	 
  </tr>

</table>
<p><b>'.stripslashes(get_option('sp_rm_application_disclaimer')).'</b></p>

<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td>Type your initials:</td>
    <td><input type="text" name="sign" size="5" class="required"></td>
	 <td>'.date("l F jS Y").'</td>
  <td></td>
  </tr>
<tr><td></td><td></td><td>Please check all information before submitting. </td><td><input type="submit" name="submit-app" value="Submit Application" class="button"></td></tr>
</table>
</form></div>
';
	
	
	$application_filter = '';
	$application_filter = apply_filters('sprm_custom_application',$application_filter,$rental);
	
	if($application_filter != ''){
	unset($content);
	$content = $application_filter;	
	}
	return $content;
	
}
function sp_rm_app_init($atts){
global $wpdb,$current_user;
		 



  if ( !is_user_logged_in() && get_option('sp_rm_require_reg')  == 1 ) { 
 
sp_rm_redirect('/login/?redirect_to='.urlencode($_SERVER['REQUEST_URI']).'&reauth=1');
exit;
	 }else{
	$data = SpRmApplicationForm();
	return $data;
	 }


}
add_shortcode( 'sp_rm_listing_applications', 'sp_rm_app_init' );
?>