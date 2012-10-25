<?php


function sp_rm_show_applications($id = NULL){
	
		global $wpdb;
		
		
		
		
			if($id == NULL){
			$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications order by date", ARRAY_A);	
			$content .='<h1>'.__("Applications List","sp-rm").'</h1>'. SpRmNavigationMenu().'	 ';
			}else{
				
			$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications where property = $id", ARRAY_A);
				$content .='<h1>'.__("Applications","sp-rm").'</h1> ';
				
			}
			


						$content .='

	 
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>

<th >Property</th>

<th>'.__("Name","sp-rm").'</th>
<th>'.__("Date","sp-rm").'</th>
<th>'.__("Phone","sp-rm").'</th>

<th>'.__("Action","sp-rm").'</th>
</tr>
	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
		
		$re = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$r[$i]['property'] ."'", ARRAY_A);	
		
		$content .='<tr>
		<td>'.$re[0]['address'].' #'.$re[0]['unit'].', '.$re[0]['city'].' '.$re[0]['state'].'</td>
		<td>'.$r[$i]['name'].'</td>
		<td>'.date("l F jS Y",strtotime($r[$i]['date'])).'</td>
		<td>'.$r[$i]['phone'].'</td>
		<td><a  class="button" href="admin.php?page=sp-rm-applications&function=delete&id='.$r[$i]['id'].'">'.__("Delete","sp-rm").'</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-applications&function=edit&id='.$r[$i]['id'].'">'.__("View","sp-rm").'</a> 
	
	<a class="button" style="margin-left:20px" href="../wp-content/plugins/sp-rental-manager/download.php?function=pdf&id='.$r[$i]['id'].'" target="_blank">'.__("Print","sp-rm").'</a>
	</td>
		</tr>';
		
	}
	
return  $content;
}


function sp_rm_view_application(){
	
	global $wpdb;
	
	if($_GET['function'] == 'delete'){
		
		$wpdb->query("DELETE FROM ".$wpdb->prefix . "sp_rm_applications WHERE id = '".$wpdb->escape($_GET['id'])."'	");
		sp_rm_redirect('admin.php?page=sp-rm-applications');
		
	}
	
	
	
	
	
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications where id = '".$wpdb->escape($_GET['id'])."'", ARRAY_A);		
	$rental = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$r[0]['property']."'", ARRAY_A);		
	
	$address1 = unserialize($r[0]['address1']);
	$address2 = unserialize($r[0]['address2']);
	$ref1 = unserialize($r[0]['ref1']);
	$ref2 = unserialize($r[0]['ref2']);
	$employ1 = unserialize($r[0]['employ1']);
	$employ2 = unserialize($r[0]['employ2']);
	$rel1 = unserialize($r[0]['rel1']);
	
	
	$content = '	
	<h1>Application for: '.stripslashes($r[0]['name']).'</h1>'. SpRmNavigationMenu().'
	<div style="width:700px">
	
	<h2>Application</h2>
  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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


	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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

	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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
		
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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
			  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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
		  <table class="wp-list-table widefat fixed posts" cellspacing="0">
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

  <table class="wp-list-table widefat fixed posts" cellspacing="0">
  <tr>
    <td><strong>Type your initials:</strong></td>
    <td>'.stripslashes($r[0]['sign']).'</td>
	 <td>'.date("l F jS Y",strtotime($r[0]['date'])).'</td>
  <td></td>
  </tr>

</table></div>';
	return $content;
}
function sp_rm_applications_admin(){
	
	
global $wpdb;


if($_GET['id'] == ""){
	
	
echo sp_rm_show_applications();
}else{
	
echo sp_rm_view_application();	
}
	
}


?>