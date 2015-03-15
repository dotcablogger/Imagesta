jQuery(document).ready(function($) {

	//Autofill the token and id
	var hash = window.location.hash,
        token = hash.substring(14),
        id = token.split('.')[0];
    //If there's a hash then autofill the token and id
    if(hash){
        $('#bmi_config').append('<div id="bmi_config_info"><p><b>Access Token: </b><input type="text" size=58 readonly value="'+token+'" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p><p><b>User ID: </b><input type="text" size=12 readonly value="'+id+'" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p><p>Copy and paste these into the fields below, or use a different Access Token and User ID if you wish.</p></div>');
    }
	
	//Tooltips
	jQuery('#bmi_admin .bmi_tooltip_link').click(function(){
		jQuery(this).siblings('.bmi_tooltip').slideToggle();
	});

    //Add the color picker
	if( jQuery('.bmi_colorpick').length > 0 ) jQuery('.bmi_colorpick').wpColorPicker();

	//Check User ID is numeric
	jQuery("#bm_instagram_user_id").change(function() {

		var bmi_user_id = jQuery('#bm_instagram_user_id').val(),
			$bmi_user_id_error = $(this).closest('td').find('.bmi_user_id_error');

		if (bmi_user_id.match(/[^0-9, _.-]/)) {
  			$bmi_user_id_error.fadeIn();
  		} else {
  			$bmi_user_id_error.fadeOut();
  		}

	});

});
