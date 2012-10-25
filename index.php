<?php
/*
Plugin Name: SP Rental Manager
Plugin URI: http://www.smartypantsplugins.com
Description: A wordpress plugin to manage rental properties
Author: SmartyPants
Version: 1.0.9
Author URI: http://www.smartypantsplugins.com
*/

load_plugin_textdomain( 'sp-rm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


$rm_preu_ver = 'Free version';

include 'includes/functions.php';
include 'includes/mail.php';
include 'admin/options.php';
include 'admin/applications.php';
include 'admin/developments.php';
include 'user/applications.php';
include 'user/shortcodes.php';

add_action('admin_menu', 'sp_rm_menu');

global $sp_rm_version;
$sp_rm_version = "1.0.9";
define('SALT', '08934587973238746238746237'); 


function sp_rm_listings_install() {
   global $wpdb;
   global $sp_rm_listings ;

      

$sql = "

CREATE TABLE ".$wpdb->prefix . "sp_rm_applications (
  id int(11) NOT NULL AUTO_INCREMENT,
  property varchar(255) NOT NULL,
  date date NOT NULL,
  address1 text NOT NULL,
  address2 text NOT NULL,
  employ1 text NOT NULL,
  employ2 text NOT NULL,
  name varchar(255) NOT NULL,
  s blob NOT NULL,
  dob varchar(255) NOT NULL,
  phone varchar(255) NOT NULL,
  cell varchar(255) NOT NULL,
  children text NOT NULL,
  ref1 text NOT NULL,
  ref2 text NOT NULL,
  rel1 text NOT NULL,
  sign varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ;


CREATE TABLE  ".$wpdb->prefix . "sp_rm_developments (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ;


CREATE TABLE ".$wpdb->prefix . "sp_rm_rentals (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  unit varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  price varchar(255) NOT NULL,
  description text NOT NULL,
  status int(1) NOT NULL,
  date date NOT NULL,
  photo varchar(255) NOT NULL,
  did varchar(255) NOT NULL,
  PRIMARY KEY (id)
)  ;



";




   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
 
   add_option("sp_rm_version", $sp_rm_version );
}

function sp_rm_listings_update(){
	
	 global $wpdb;
	    global $sp_rm_listings ;
		global $sp_rm_version ;
		
 $updatesql = $wpdb->query("ALTER TABLE `".$wpdb->prefix."sp_rm_rentals` 
 							ADD `features` TEXT NOT NULL ,
							ADD `features_values` TEXT NOT NULL ");
							
				  add_option("sp_rm_version", $sp_rm_version );			
	
}
add_action('plugins_loaded', 'sp_rm_listings_update');
register_activation_hook(__FILE__,'sp_rm_listings_install');


if(get_option('sp_rm_list_thumb_size_w') == ""){
	
		update_option( 'sp_rm_list_thumb_size_w',500 ); 
		update_option( 'sp_rm_list_thumb_size_h',500 ); 
		update_option( 'sp_rm_thumb_size_w',150 ); 
		update_option( 'sp_rm_thumb_size_h',150 ); 	
	
}
//load javascript
function sp_rm_init() {
	  wp_enqueue_script('jquery');
	
	
	if (!is_admin()) {
		  wp_enqueue_script('sp_rm_validation', ''.get_bloginfo('wpurl').'/wp-content/plugins/sp-rental-manager/js/validation.js');
		   wp_enqueue_script('sp_rm_scripts', ''.get_bloginfo('wpurl').'/wp-content/plugins/sp-rental-manager/js/scripts.js');
	}else{
	  wp_enqueue_script('sp_rm_js', ''.get_bloginfo('wpurl').'/wp-content/plugins/sp-rental-manager/js/admin.js');
	   wp_enqueue_script('thickbox');
	}
}
//load css files
function sp_rm_load_css(){

	if (!is_admin()) {

	echo "<link rel='stylesheet' id='thickbox-css'  href='".get_bloginfo('wpurl')."/wp-content/plugins/sp-rental-manager/style.css' type='text/css' media='all' />";	
	}else{
	echo "<link rel='stylesheet' id='thickbox-css'  href='".get_bloginfo('wpurl')."/wp-includes/js/thickbox/thickbox.css' type='text/css' media='all' />";	
	}
}

add_action('wp_head', 'sp_rm_load_css');	
add_action('init', 'sp_rm_init');
add_action( 'admin_enqueue_scripts', 'sp_rm_load_css' );

function sp_rm_menu() {
	
	
	

	  add_menu_page( 'SpRm', ''.__("Rentals","sp-rm").'',  'manage_options', 'SpRm', 'SpRmOptionsPage');
	  add_submenu_page( 'SpRm', ''.__("Applications","sp-rm").'', ''.__("Applications","sp-rm").'', 'manage_options', 'sp-rm-applications', 'sp_rm_applications_admin');
	  add_submenu_page( 'SpRm', ''.__("Listings","sp-rm").'', ''.__("Listings","sp-rm").'', 'manage_options', 'sp-rm-developments', 'sp_rm_view_developments');
	 

}

 
?>