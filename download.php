<?php
require( '../../../wp-load.php' );
	
	global $wpdb;
	ini_set("memory_limit","80M");
	
	
	$function = $_GET['function'];
	




switch($function){
	
	
	case"pdf":
	
		require_once("includes/dompdf/dompdf_config.inc.php");
	
	$id = $_GET['id'];
	$html =SpRmApplicationHTML($id);
	if($_GET['html'] == 1){
		
		echo $html;
	}else{
	//$html ='<p>Hello</p>';
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream("export.pdf");
	}
	break;
	
}
?>