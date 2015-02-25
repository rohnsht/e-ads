$(document).ready(function(){
	$('#sign-in').click(function(){
		$.ajax({
			method: 'GET',
			url: 'login',
			success: function(data){
				$('#ajax').hide();
				$('#ajax').slideDown('slow').html(data);
				$('#ajax').off('submit','#loginForm',login).on('submit','#loginForm',login);

				$('#ajax').on('blur','#username', function(){
                    var username = $('#username').val();
                    if(username.trim() == ""){
                        $("#username-group").addClass('has-error');
                        $('#username-error').addClass('help-block');
                        $("#username-error").text('The username field is required.');
                    }
                }).on('focusin','#username',function(){
                    $("#username-group").removeClass('has-error');
                    $("#username-error").text('');
                }); 

                $('#ajax').on('blur','#password', function(){
                    var password = $('#password').val();
                    if(password.trim() == ""){
                        $("#password-group").addClass('has-error');
                        $('#password-error').addClass('help-block');
                        $("#password-error").text('The password field is required.');
                    }else if(password.length < 3){ 
                        $("#password-group").addClass('has-error');
                        $('#password-error').addClass('help-block');
                        $("#password-error").text('Password must have at least 3 characters.');
                    }
                }).on('focusin','#password',function(){
                     $("#password-group").removeClass('has-error');
                    $("#password-error").text('');
                });
                
			}
		});
	});
});

function login(e){
	e.preventDefault();
	var formData = new FormData();
	formData.append('username', $('#username').val());
	formData.append('password', $('#password').val());
	formData.append('remember', $('#remember:checked').val());

	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });

	$.ajax({
		method: 'POST',
		url: 'login',
		processData: false,
		contentType: false,
		dataType: 'json',
		data: formData,
		success: function(data){

			if(data.valid == 'false'){
				$.each(data.errors, function(index, error){
					$('#'+index+'-group').addClass('has-error');
					$('#'+index+'-error').addClass('help-block');
					$('#'+index+'-error').text(error);
				});
			}else if(data.role == 'publisher'){
				window.location.href = data.route;
			}else if(data.role == 'advertiser'){
				window.location.href = data.route;
			}
			else{
				$('#username-error').text('');
				$('#username-group').addClass('has-error');
				$('#password-group').addClass('has-error');
				$('#password-error').addClass('help-block');
				$('#password-error').text('Username and Password donot match.');
			}

		},
		error: function(){}
	});
}