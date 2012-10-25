	
	
	function sp_rm_add_feature(){
		
		jQuery('#sp_rm_feature_end').before('<div id="sp_rm_feature_main" class="sp_rm_feature">Feature Name <input type="text" name="features[]" value=""> Feature Value <input type="text" name="features_value[]" value=""></div>');
	}
	
	function wp_makeFileUpload(uploaddiv,sendto){
	
		var formfield;
		
		jQuery(uploaddiv).live('click',function() {
 			//formfield = jQuery('#adpicture').attr('name');
 			formfield = jQuery(sendto).attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&height=550&width=700');
 			return false;
		});
		
		
		window.send_to_editor = function(html) {
 			//imgurl = jQuery('img',html).attr('src');
 			//jQuery('#adpicture').val(imgurl);
 			mediaurl = jQuery('img',html).attr('src');
			jQuery('.imgsrc').attr('src',mediaurl);
			
			
 			jQuery('#' + formfield).val(mediaurl);
 			tb_remove();
		}
		
	}
	
	
		
	function wp_makeFileUploadAddImage(uploaddiv,sendto){
	
		var formfield;
		
		jQuery(uploaddiv).live('click',function() {
 			//formfield = jQuery('#adpicture').attr('name');
 			formfield = jQuery(sendto).attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&height=550&width=700');
 			return false;
		});
		
		window.send_to_editor = function(html) {
 			//imgurl = jQuery('img',html).attr('src');
 			//jQuery('#adpicture').val(imgurl);
 			mediaurl = jQuery('img',html).attr('src');
			jQuery('.imgsrc_add').attr('src',mediaurl);
			
			jQuery('.displayimg').show();
 			jQuery('#' + formfield).val(mediaurl);
 			tb_remove();
	
		}
		
	}