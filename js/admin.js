	
	
	
	
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