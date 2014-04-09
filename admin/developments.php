<?php
add_action('admin_init', 'sp_rm_editor_admin_init');
add_action('admin_head', 'sp_rm_editor_admin_head');
 
function sp_rm_editor_admin_init() {
  wp_enqueue_script('word-count');
  wp_enqueue_script('post');
  wp_enqueue_script('editor');
  wp_enqueue_script('media-upload');
}
 
function sp_rm_editor_admin_head() {
  wp_tiny_mce();
}


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
echo $content;
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
		
		$insert['did'] = $_POST['did'];
		$insert['description'] = $_POST['description'];
		
		$insert['features'] = serialize(array_filter($_POST['features']));
		$insert['features_values'] = serialize(array_filter($_POST['features_value']));
		
		if($_FILES['photo']['name'] != ""){			
     	$photo = wp_upload_bits($_FILES['photo']["name"], null, file_get_contents($_FILES['photo']["tmp_name"]));	

		$insert['photo'] = 	$photo['url'];	
	
		}		
		
		
		
		if($_POST['id'] != ""){
		$where['id'] =$_POST['id'] ;
	    $wpdb->update(  "".$wpdb->prefix . "sp_rm_rentals", $insert , $where );	
		}else{
		$wpdb->insert( "".$wpdb->prefix . "sp_rm_rentals",$insert );
		}
	do_action('wp_rm_development_action',$_POST['id']);
	sp_rm_redirect('admin.php?page=sp-rm-developments');
	
}



if($_GET['id'] != ""){
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_rentals where id = '".$wpdb->escape($_GET['id'])."'", ARRAY_A);
	
	$dev = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_developments  where id = '".$wpdb->escape($r[0]['did'])."'", ARRAY_A);	
		
}


$devs = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_developments order by name", ARRAY_A);	

if($r[0]['id'] != "" && $_GET['pics'] == 1){
	if(RM_PREMIUM == 1){
		echo '<div style="padding:10px;"><a href="admin.php?page=sp-rm-developments&function=manage-listing&id='.$_GET['id'].'" class="button">&laquo; Back to listing</a></div>';
	echo sp_rm_admin_multiple_images($r[0]['id']);
	}

}else{
if(RM_PREMIUM == 1){
echo '<div style="padding:10px;"><a href="admin.php?page=sp-rm-developments&function=manage-listing&id='.$_GET['id'].'&pics=1" class="button">Add more images</a></div>';
}


echo  ''. $portfolio_list_dev .'



<form action="admin.php?page=sp-rm-developments&function=manage-listing" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="'.$r[0]['id'].'">
  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	
	<tbody>
	<tr>
	<td style="width:150px">'.__("Name","sp-rm").':</td>
	<td><input type="text" name="dev-name" value="'.$r[0]['name'].'"></td>
	</tr>
		<tr>
	<td>'.__("Development","sp-rm").':</td>
	<td><select name="did"><option value="'.$dev[0]['id'].'" selected="selected">'.$dev[0]['name'].'</option>
	
	
	';
	
	for($i=0; $i<count($devs); $i++){
		echo  '<option value="'.$devs[$i]['id'].'">'.$devs[$i]['name'].'</option>';
	}
	
	echo '</select></td>
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

	<input type="file" id=photo" name="photo" /><br>';
	if($r[0]['photo'] != ""){
		echo  '<img src="'.sp_rm_thumbnail($r[0]['photo'], 200, 150).'"  class="imgsrc">';
	}else{
		echo '<img src="" class="imgsrc">';
	}
	
	echo '
	
</td>
<tr>
		<td>'.__("Description","sp-rm").':</td>
	<td>'.the_editor(stripslashes($r[0]['description']), "description", "", false).'</td>
	</tr>
	
	<tr>
		<td>'.__("Features","sp-rm").':</td>
	<td>';
	
	$features = unserialize($r[0]['features']);
	$features_values = unserialize($r[0]['features_values']);
	
	
	echo '<div id="sp_rm_feature_main" class="sp_rm_feature">Feature Name <input type="text" name="features[]" value="'.stripslashes($features[0]).'"> Feature Value <input type="text" name="features_value[]" value="'.stripslashes($features_values[0]).'"> <a href="javascript:sp_rm_add_feature();"><img src="../wp-content/plugins/sp-rental-manager/images/add.png"></a></div>';
	$i= 1;
	if($features[0] != ""){
	foreach( $features as $key => $value){
	
		
		echo '<div id="sp_rm_feature_main" class="sp_rm_feature">Feature Name <input type="text" name="features[]" value="'.stripslashes($features[$i]).'"> Feature Value <input type="text" name="features_value[]" value="'.stripslashes($features_values[$i]).'"></div>';
			$i++;
	}
	}
	echo '<div id="sp_rm_feature_end"></div>
	</td>
	</tr>';
	
	do_action('wp_rm_development_form',$r);
  echo '<tr>
  
	<td></td>
	<td><input type="submit" name="save" value="'.__("Save","sp-rm").'"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';	

if($_GET['id'] != ""){
	
	  if(class_exists('sprm_FormBuilder')){
		  
		  global $sprm_FormBuilder;
		echo $sprm_FormBuilder->ApplicationView($r[0]['id']);  
	  }else{
		echo  sp_rm_show_applications($r[0]['id']);  
	  }
	
	
	
	
}

}
	return $content;
}



function sp_rm_view_developments(){
	
	
	global $wpdb;
	echo  '	<h1>'.__("Developments","sp-rm").'</h1> '. SpRmNavigationMenu().'';
				
			if($_GET['function'] == 'manage-development'){		
			
			echo  sp_rm_manage_developments();	
			
			}elseif($_GET['function'] == 'manage-listing'){		
			
			echo  sp_rm_manage_listing();			
			
			}elseif($_GET['function'] == 'delete-development'){
				
			$wpdb->query("DELETE FROM ".$wpdb->prefix . "sp_rm_developments WHERE id = ".$wpdb->escape($_GET['id'])."	");	
			sp_rm_redirect('admin.php?page=sp-rm-developments');
			
			}elseif($_GET['function'] == 'delete-listing'){
				
			$wpdb->query("DELETE FROM ".$wpdb->prefix . "sp_rm_rentals WHERE id = ".$wpdb->escape($_GET['id'])."	");	
			sp_rm_redirect('admin.php?page=sp-rm-developments');
			}else{
				
	
	
			$r = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_developments order by name", ARRAY_A);	
			
			

		
			
			
			
			
				echo '

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
		
		echo '<tr>
		<td>'.$r[$i]['id'].'</td>
		<td>'.$r[$i]['name'].'</td>
	
		<td><a  class="button" href="admin.php?page=sp-rm-developments&function=delete-development&id='.$r[$i]['id'].'">'.__("Delete","sp-rm").'</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-developments&function=manage-development&id='.$r[$i]['id'].'">'.__("View","sp-rm").'</a> 

	
	 </td>
		</tr>';
		
				}
				
				echo  '</tbody></table>
				
				<h1>'.__("Listings","sp-rm").'</h1>
				
				';
				
	
		unset($r);
	
	
	
			if($_GET['function'] == 'publish'){
				$insert['status'] = 	$_GET['publish'];	
	
	
	
		$where['id'] =$_GET['id'] ;
	    $wpdb->update(  "".$wpdb->prefix . "sp_rm_rentals", $insert , $where );	
			}
			
			$r = $wpdb->get_results("SELECT *  FROM  ".$wpdb->prefix . "sp_rm_rentals order by name", ARRAY_A);	
			
			

		
			
			
			
			
				echo '

	 <a class="button" href="admin.php?page=sp-rm-developments&function=manage-listing">'.__("Add Listing","sp-rm").'</a>
	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>

<th width="50">'.__("ID","sp-rm").'</th>
<th >'.__("Applications","sp-rm").'</th>
<th>'.__("Name","sp-rm").'</th>
<th>'.__("Address","sp-rm").'</th>
<th width="450">'.__("Action","sp-rm").'</th>
</tr>
	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
			$ree = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications where property = ".$r[$i]['id']."", ARRAY_A);		
		if($r[$i]['status'] == 0){
	$publish = '<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-developments&function=publish&publish=1&id='.$r[$i]['id'].'">'.__("Unpublish","sp-rm").'</a>';	
		$bg= '';
	}else{
		$publish = '<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-developments&function=publish&publish=0&id='.$r[$i]['id'].'" >'.__("Publish","sp-rm").'</a>';		
	$bg= ' style="background-color:#ffe2e2" ';
	}
		echo '<tr '.$bg.'>
		<td>'.$r[$i]['id'].'</td>';
		
		  if(class_exists('sprm_FormBuilderUser')){
			global $sprm_FormBuilder;
			 echo '<td>'.$sprm_FormBuilder->applicationCount($r[$i]['id']).'</td>'; 
		  }else{
			  echo '<td>'.count($ree).'</td>';
		  }
	
	
	
		echo '
		<td>'.$r[$i]['name'].'</td>
		<td>'.$r[$i]['address'].'</td>
		<td><a  class="button" href="admin.php?page=sp-rm-developments&function=delete-listing&id='.$r[$i]['id'].'">'.__("Delete","sp-rm").'</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=sp-rm-developments&function=manage-listing&id='.$r[$i]['id'].'">'.__("View","sp-rm").'</a> 
		<a class="button" style="margin-left:20px" href="../wp-content/plugins/sp-rental-manager/download.php?function=pdf-all&id='.$r[$i]['id'].'" target="_blank">'.__("Download Applications","sp-rm").'</a>
	'.	$publish .'
	</td>
		</tr>';
		
				}
				
				echo  '</tbody></table>';
				
	
	
	
	
	
	
	
	
	
	
	
			}	
				
				echo $content;
			
}

?>