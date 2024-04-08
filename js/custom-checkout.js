jQuery(document).ready(function(){
	jQuery('.thwmscf-buttons #action-next').on('click',function(){
		var billing_first_name = jQuery('#billing_first_name').val();
	    setCookie("billing_first_name", billing_first_name, 365);
	})

	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		let expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}


});