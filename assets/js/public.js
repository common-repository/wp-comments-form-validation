(function($) {
	"use strict";
	if ($.validator) {
		$('#commentform').validate({
			rules: {
				author: {
					required: (wp_cf_validation.require_name_email) ? true : false,
					minlength: 2
				},
				email: {
					required: (wp_cf_validation.require_name_email) ? true : false,
					email: true
				},
				comment: {
					required: true,
					minlength: 2
				}
			},
			messages: {
				author: {
					required: wp_cf_validation.messages.name,
					minlength: $.validator.format(wp_cf_validation.messages.minlength)
				},
				email: {
					required: wp_cf_validation.messages.email,
					email: wp_cf_validation.messages.email_invalid
				},
				comment: {
					required: wp_cf_validation.messages.comment,
					minlength: $.validator.format(wp_cf_validation.messages.minlength)
				}
			},
			errorClass: wp_cf_validation.classes.error.join(' ')
		});
	}

}(jQuery));