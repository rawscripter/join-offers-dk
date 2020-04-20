$(document).on('submit', '.registration_form', function(event) {
	event.preventDefault();
	/* Act on the event */
	var data = $('.registration_form').serialize();
	$.ajax({
			data: data,
			type: "POST",
			url: "admin/app/action/user_registration.php",
		success: function(data){	
			alert(data);
		}
	});
});

$(document).on('submit', '.login_form', function(event) {
	event.preventDefault();
	/* Act on the event */
	var data = $('.login_form').serialize();
		$.ajax({
			data: data,
			type: "POST",
			url: "admin/app/action/user_login.php",
				
		success: function(data){	
		    	if ($.trim(data) == 'yes') {
				window.location.href = "index.php";
			}else{
				console.log(data);
			}
		}
	});
});