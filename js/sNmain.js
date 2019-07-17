jQuery(document).ready(function( $ ) {
	$('#subscribe-form').submit(function(e){
		e.preventDefault();

		var dataForm = $('#subscribe-form').serialize();
		//var urlsend = $('#subscribe-form').attr('action');
		$.ajax({
			url     : ajax_var.url,
			method  : 'POST',
			beforeSend: function(xhr) {
				xhr.setRequestHeader( 'X-WP-Nonce', ajax_var.nonce);
			},
			data: dataForm,
			 success: function(dataForm){
				$('.form-msg').addClass('sucsses');
				$('.form-msg').removeClass('error');
				$('.form-msg').text(dataForm);
			 }						            
		}).fail(function(data){
			$('.form-msg').addClass('error');
			$('.form-msg').removeClass('sucsses');
			if(data.responseText != ''){
				$('.form-msg').text(data.responseText);
			}else{
				$('.form-msg').text('there is an error try again');
			}
		})	
	})	
});