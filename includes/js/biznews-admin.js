jQuery(document).ready(function($) {
	if($('.custom_repeatable tbody').length == 1){
		$('.repeatable-remove').css('visibility', 'hidden');
	}
	else{
		$('.repeatable-remove').css('visibility', 'visible');
	}
	$('.repeatable-add').click(function() {
		$('.repeatable-remove').css('visibility', 'visible');
	    field = $(this).closest('table').find('tr:last').clone(true);
	    fieldLocation = $(this).closest('table').find('tr:last');
	    $('input', field).val('').attr('name', function(index, name) {
	        return name.replace(/(\d+)/, function(fullMatch, n) {
	            return Number(n) + 1;
	        });
	    })
	    field.insertAfter(fieldLocation, $(this).closest('td'))
	    return false;
	});
	 
	$('.repeatable-remove').click(function(){
	    $(this).parent().parent().remove();
		if($('.custom_repeatable tr').length == 1){
			$('.repeatable-remove').css('visibility', 'hidden');
		}
		else{
			$('.repeatable-remove').css('visibility', 'visible');
		}
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
     
    $('.custom_clear_image_button').click(function() {
        var defaultImage = $(this).parent().siblings('.custom_default_image').text();
        $(this).parent().siblings('.custom_upload_image').val('');
        // $(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
        return false;
    });
 
});