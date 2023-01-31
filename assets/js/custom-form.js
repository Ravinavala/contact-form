// jQuery code
jQuery(document).ready(function () {
    jQuery("#custom_contact_form").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            contact_no: {
                required: true,
                phoneUS: true
            },
            comment: {
                required: true,
                minlength: 10
            },
            country: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 3 characters long"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            contact_no: {
                required: "Please enter your contact number",
                phoneUS: "Please enter a valid US phone number"
            },
            comment: {
                required: "Please enter a comment",
                minlength: "Your comment must be at least 10 characters long"
            },
            country: {
                required: "Please select your country"
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            var alldata = jQuery("#custom_contact_form").serialize();
            jQuery('#message').text('Processing...');
            var admin_url = custom_form_ajax.ajaxurl;
            jQuery.ajax({
                url: admin_url,
                type: "POST",
                data: alldata + '&action=contactform_data',
                dataType: "html",
                success: function (data) {

                    jQuery('#message').text('');
                    jQuery('#cfserr_msg').html('');
                    if (data !== 0) {
                        console.log('aa' + data);
                        jQuery('#cfs_msg').text('Data has been Sent!');
                        setTimeout(function () {
                            jQuery('#cfs_msg').fadeOut('slow');
                        }, 3000);
                    } else {
                        jQuery('#cfs_msg').text('');
                        jQuery('#cfserr_msg').text('Something went wrong.');
                        setTimeout(function () {
                            jQuery('#cfserr_msg').fadeOut('fast');
                        }, 4000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
            return false;
        }

    });
});
jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 &&
        phone_number.match(/^(1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/);
}, "Please specify a valid phone number");

