<?php


function sp_rm_manage_developments(){
	
global $wpdb;


if($_POST['save'] != ""){
	
	
	
	
		$insert['name'] = $_POST['dev-name'];

		
		if($_POST['id'] != ""){
		$where['id'] =$_POST['id'] ;
	    $wpdb->update(  "".$wpdb->prefix . "sp_rm_developments", $insert , $where );	
		}else{
		$wpdb->insert( "".$wpdb->prefix . "sp_rm_developments",$insert );
		}
	
	sp_rm_redirect('admin.php?page=sp-rm-developments');
	
}



if($_GET['id'] != ""){
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_developments where id = '".$wpdb->escape($_GET['id'])."'", ARRAY_A);		
}

$content .= ''. $portfolio_list_dev .'
<form action="admin.php?page=sp-rm-developments&function=manage-development" method="post">
<input type="hidden" name="id" value="'.$r[0]['id'].'">
  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	
	<tbody>
	<tr>
	<td>'.__("Name","sp-rm").':</td>
	<td><input type="text" name="dev-name" value="'.$r[0]['name'].'"></td>
	</tr>
		<tr>
	<td></td>
	<td><input type="submit" name="save" value="Save"></td>
	</tr>
	</tbody>

</form>




';	
	return $content;
}


function sp_rm_manage_listing(){
	
global $wpdb;


if($_POST['save'] != ""){
	
	
	
	
		$insert['name'] = $_POST['dev-name'];
		$insert['address'] = $_POST['address'];
		$insert['unit'] = $_POST['unit'];
		$insert['state'] = $_POST['state'];
		$insert['city'] = $_POST['city'];
		$insert['price'] = $_POST['price'];
		$insert['photo'] = $_POST['photo'];
		$insert['did'] = $_POST['did'];
	
		
		if($_POST['id'] != ""){
		$where['id'] =$_POST['id'] ;
	    $wpdb->update(  "".$wpdb->prefix . "sp_rm_rentals", $insert , $where );	
		}else{
		$wpdb->insert( "".$wpdb->prefix . "sp_rm_rentals",$insert );
		}
	
	sp_rm_redirect('admin.php?page=sp-rm-developments');
	
}



if($_GET['id'] != ""){
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$wpdb->escape($_GET['id'])."'", ARRAY_A);
	
	$dev = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_developments  where id = '".$wpdb->escape($r[0]['did'])."'", ARRAY_A);	
		
}


$devs = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_developments order by name", ARRAY_A);	

$content .= ''. $portfolio_list_dev .'
<script type="text/javascript">
	jQuery(function() {
	
	
	wp_makeFileUpload("#featured_upload","#photo");
		
	});
		
		</script>
<form action="admin.php?page=sp-rm-developments&function=manage-listing" method="post">
<input type="hidden" name="id" value="'.$r[0]['id'].'">
  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	
	<tbody>
	<tr>
	<td>'.__("Name","sp-rm").':</td>
	<td><input type="text" name="dev-name" value="'.$r[0]['name'].'"></td>
	</tr>
		<tr>
	<td>'.__("Development","sp-rm").':</td>
	<td><select name="did"><option value="'.$dev[0]['id'].'" selected="selected">'.$dev[0]['name'].'</option>
	
	
	';
	
	for($i=0; $i<count($devs); $i++){
		$content .= '<option value="'.$devs[$i]['id'].'">'.$devs[$i]['name'].'</option>';
	}
	
	$content .='</select></td>
	</tr>
	
	<tr>
		<td>'.__("Address","sp-rm").':</td>
	<td><input type="text" name="address" value="'.$r[0]['address'].'"></td>
	</tr><tr>
		<td>'.__("Unit","sp-rm").':</td>
	<td><input type="text" name="unit" value="'.$r[0]['unit'].'"></td>
	</tr><tr>
		<td>'.__("City","sp-rm").':</td>
	<td><input type="text" name="city" value="'.$r[0]['city'].'"></td>
	</tr><tr>
		<td>'.__("State","sp-rm").':</td>
	<td><input type="text" name="state" value="'.$r[0]['state'].'"></td>
	</tr><tr>
		<td>'.__("Price","sp-rm").':</td>
	<td><input type="text" name="price" value="'.$r[0]['price'].'"></td>
	</tr>
	    <tr>
	<td>'.__("Featured Image","sp-rm").'</td>
	<td>
	<input type="hidden" id="photo" name="photo" value="'.$r[0]['photo'].'">
	<input id="featured_upload" class="button" value="Upload" /><br>';
	if($r[0]['photo'] != ""){
		$content .= '<img src="'.$r[0]['photo'].'" width="150" class="imgsrc">';
	}else{
		$content .='<img src="" class="imgsrc">';
	}
	
	$content .='
	
</td>

  <tr>
		<tr>
	<td></td>
	<td><input type="submit" name="save" value="'.__("Save","sp-rm").'"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';	

if($r[0]['id'] != ""){
	if(RM_PREMIUM == 1){
	$content .=sp_rm_admin_multiple_images($r[0]['id']);
	}
$content .= sp_rm_show_applications($r[0]['id']);
}
	return $content;
}



function sp_rm_view_developments(){
	
	
	global $wpdb;
	$content .= '	<h1>'.__("Developments","sp-rm").'</h1> '. SpRmNavigationMenu().'';
				
			if($_GET['function'] == 'manage-development'){		
			
			$content .= sp_rm_manage_developments();	
			
			}elseif($_GET['function'] == 'manage-listing'){		
			
			$content .= sp_rm_manage_listing();			
			
			}elseif($_GET['function'] == 'delete-development'){
				
			$wpdb->query("DELETE FROM ".$wpdb->prefix . "sp_rm_developments WHERE id = ".$wpdb->escape($_GET['id'])."	");	
			sp_rm_redirect('admin.php?page=sp-rm-developments');
			
			}elseif($_GET['function'] == 'delete-listing'){
				
			$wpdb->query("DELETE FROM ".$wpdb->prefix . "sp_rm_rentals WHERE id = ".$wpdb->escape($_GET['id'])."	");	
			sp_rm_redirect('admin.php?page=sp-rm-developments');
			}else{
				
	
	
			$r = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_developments order by name", ARRAY_A);	
			
			

		
			
			
			
			
				$content .='

	 <a class="button" href="admin.php?page=sp-rm-developments&function=manage-development">'.__("Add Development","sp-rm").'</a>
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>

<th width="50">'.__("ID","sp-rm").'</th>
<th>'.__("Name","sp-rm").'</th>
<th>'.__("Action","sp-rm").'</th>
</tr>
	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
		$content .='<tr>
		<td>'.$r[$i]['id'].'</td>
		<td>'.$r[$i]['name'].'</td>
	
		<td><a  class="button" href="admin.php?page=sp-rm-developments&function=delete-development&id='.$r[$i]['id'].'">'.__("Delete","sp-rm").'</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-developments&function=manage-development&id='.$r[$i]['id'].'">'.__("View","sp-rm").'</a> 

	
	 </td>
		</tr>';
		
				}
				
				$content .= '</tbody></table>
				
				<h1>'.__("Listings","sp-rm").'</h1>
				
				';
				
	
		unset($r);
	
			$r = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_rentals order by name", ARRAY_A);	
			
			

		
			
			
			
			
				$content .='

	 <a class="button" href="admin.php?page=sp-rm-developments&function=manage-listing">'.__("Add Listing","sp-rm").'</a>
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>

<th width="50">'.__("ID","sp-rm").'</th>
<th >'.__("Applications","sp-rm").'</th>
<th>'.__("Name","sp-rm").'</th>
<th>'.__("Address","sp-rm").'</th>
<th>'.__("Action","sp-rm").'</th>
</tr>
	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
			$ree = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications where property = ".$r[$i]['id']."", ARRAY_A);		
		
		$content .='<tr>
		<td>'.$r[$i]['id'].'</td>
		<td>'.count($ree).'</td>
		<td>'.$r[$i]['name'].'</td>
		<td>'.$r[$i]['address'].'</td>
		<td><a  class="button" href="admin.php?page=sp-rm-developments&function=delete-listing&id='.$r[$i]['id'].'">'.__("Delete","sp-rm").'</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-developments&function=manage-listing&id='.$r[$i]['id'].'">'.__("View","sp-rm").'</a> 
		<a class="button" style="margin-left:20px" href="../wp-content/plugins/sp-rental-manager/download.php?function=pdf-all&id='.$r[$i]['id'].'" target="_blank">'.__("Download All Applications","sp-rm").'</a>
	</td>
		</tr>';
		
				}
				
				$content .= '</tbody></table>';
				
	
	
	
	
	
	
	
	
	
	
	
			}	
				
				echo $content;
			
}

?>