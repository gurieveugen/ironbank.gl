jQuery( document ).ready(function() {
	//jQuery('.form-contact .select').jqTransform();
	//jQuery('.check-list, .select').jqTransform();
	jQuery('#n-join-now').click(function(){
		jQuery('#subscribe-form').animate({height: "show"}, 700);
		jQuery('.check-list, .select-holder').jqTransform();
        return false;
	});
    jQuery("#close-form").click(function(){
		jQuery('#subscribe-form').animate({height: "hide"}, 700);
		return false;
	});
    jQuery("li.noclick > a").click(function(){
		return false;
	});
    
    var front_slides = jQuery(".news-block .slider li").length;
    if ( front_slides > 1 ) {
        jQuery(".news-block .slider").cycle({
            fx: 'fade', 
            speed: 1000, 
            timeout: 8000, 
            pager: 'ul.switcher',
            cleartypeNoBg: true,
            pagerAnchorBuilder: function(idx, slide) { 
                return '<li><a href="#"></a></li>'; 
            }
        })
    } 
    
    jQuery("#n-join-now").click(function(){
		subscribe_form_start();
		jQuery("#subscribe-form").animate({height: "show"}, 700);
		return false;
	});
	jQuery("#n-close-form").click(function(){
		jQuery("#subscribe-form").animate({height: "hide"}, 700);
		return false;
	});
	jQuery("#n-send-form").click(function(){
		subscribe_form_submit();
		return false;
	});
	var content_height=jQuery('#content').height();
	if(content_height>1000){
		jQuery('#content').addClass('content-scroll');
	}
});

function subscribe_form_submit() {
	var n_error = "";
	var fname = trim(jQuery("#sf-fname").val());
	var lname = trim(jQuery("#sf-lname").val());
	var company = trim(jQuery("#sf-company").val());
	var email = trim(jQuery("#sf-email").val());
	var country = trim(jQuery("#sf-country").val());
	var group = trim(jQuery("#sf-group").val());
	var shares = trim(jQuery("#sf-shares").val());

	if (fname == 'First Name *') { fname = ''; }
	if (lname == 'Last Name *') { lname = ''; }
	if (email == 'Email Address *') { email = ''; }
	if (company == 'Company Name') { company = ''; }
	if (country == 'Country') { country = ''; }

	if (fname == '') {
		n_error += "Please enter First Name.\n";
	}
	if (lname == '') {
		n_error += "Please enter Last Name.\n";
	}
	if (email == '') {
		n_error += "Please enter Email Address.\n";
	} else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)) {
		n_error += "Email Address isn't valid.\n";
	}		

	if (n_error == "") {
		jQuery("#sf-nn").val(fname+' '+lname);

		jQuery("#sf-form-div").animate({height: "hide"}, 500, function(){
			jQuery("#sf-submitted-div").animate({height: "show"}, 500);
			document.subscribe_form.reset();
		});

		jQuery('#subscribe_form').ajaxSubmit(function(){});
	} else {
		alert(n_error);
	}

}

function trim(str) {
	if (str != 'undefined') {
		return str.replace(/^\s+|\s+$/g,"");
	} else {
		return '';
	}
}

function subscribe_form_start() {
	jQuery("#sf-form-div").show();
	jQuery("#sf-submitted-div").hide();
}
