<?php
require( '../../../wp-load.php' );
	
	global $wpdb;
	ini_set("memory_limit","80M");
	
	
	$function = $_GET['function'];
	




switch($function){
	
	
	

	
	case"pdf":
		echo '<body onload="window.print()">';
	$id = esc_sql($_GET['id']);
	
  if(class_exists('sprm_FormBuilderUser')){
	$html = $sprm_FormBuilderUser->buildApplication($id);  
  }else{
	$html =SpRmApplicationHTML($id);  
  }
	



echo $html;
echo '</body>';
	break;
	case"pdf-all":
		echo '<body onload="window.print()">';
	$id = esc_sql($_GET['id']);

 if(class_exists('sprm_FormBuilderUser')){
	 
	 $r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_form_entries where pid = ".$id ."", ARRAY_A);	

for($i=0; $i<count($r); $i++){
$html .='<div style="page-break-after:always;font-size:12px;">';

$html .= $sprm_FormBuilderUser->buildApplication($r[$i]['id']);   

$html.='</div>';
}
	 

 }else{
$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "sp_rm_applications where property = ".$id ."", ARRAY_A);	

for($i=0; $i<count($r); $i++){
$html .='<div style="page-break-after:always;font-size:12px;">';

$html .=SpRmApplicationHTML($r[$i]['id']);	 

$html.='</div>';
}
 }



echo $html;
echo '</body>';
	break;
}
?>