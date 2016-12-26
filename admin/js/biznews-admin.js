jQuery(document).ready(function($) {
	if($('.custom_repeatable li').length == 1){
		$('.repeatable-remove').css('visibility', 'hidden');
	}
	else{
		$('.repeatable-remove').css('visibility', 'visible');
	}
	 $('.repeatable-add').click(function() {
	 	$('.repeatable-remove').css('visibility', 'visible');
	    field = $(this).closest('td').find('.custom_repeatable li:last').clone(true);
	    fieldLocation = $(this).closest('td').find('.custom_repeatable li:last');
	    $('input', field).val('').attr('name', function(index, name) {
	        return name.replace(/(\d+)/, function(fullMatch, n) {
	            return Number(n) + 1;
	        });
	    })
	    field.insertAfter(fieldLocation, $(this).closest('td'))
	    return false;
	});
	$('.custom_upload_image_button').click(function() {
		formfield = $(this).siblings('.custom_upload_image');
		// preview = $(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			// alert(html);
			imgurl = $('img',html).attr('src');
			classes = $('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			formfield.attr('value', imgurl);
			tb_remove();
		}
		return false;
	});
	$('.repeatable-remove').click(function(){
	    $(this).parent().remove();
	    if($('.custom_repeatable li').length == 1){
			$('.repeatable-remove').css('visibility', 'hidden');
		}
		else{
			$('.repeatable-remove').css('visibility', 'visible');
		}
	    return false;
	}); 
	$('.custom_repeatable').sortable({
	    opacity: 0.6,
	    revert: true,
	    cursor: 'move',
	    handle: '.sort'
	});
 	$('.custom_clear_image_button').click(function() {
        var defaultImage = $(this).parent().siblings('.custom_default_image').text();
        $(this).parent().siblings('.custom_upload_image').val('');
        // $(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
        return false;
    });
});
