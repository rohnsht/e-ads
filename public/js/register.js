$(document).ready(function(){
    $('#sign-up, #signup').click(function(){
        $.ajax({
            method: 'GET',
            url: 'register',
            success: function(data){
                $('#ajax').hide();
                $('#ajax').slideDown('slow').html(data);
                $('#ajax').off('submit','#registerForm',register).on('submit','#registerForm',register);

                $('#ajax').on('blur','#username', function(){
                    var username = $('#username').val();
                    if(username.trim() == ""){
                        $("#username-group").addClass('has-error');
                        $('#username-error').addClass('help-block');
                        $("#username-error").text('The password field is required.');
                    }
                })
                .on('focusin','#username',function(){
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

                $('#ajax').on('blur','#password-again', function(){
                    var password = $('#password').val();
                    var pass = $('#password-again').val();
                    if(pass.trim() == ""){
                        $("#password-again-group").addClass('has-error');
                        $('#password-again-error').addClass('help-block');
                        $("#password-again-error").text('The password-again field is required.');
                    }else if(password != pass){ 
                        $("#password-again-group").addClass('has-error');
                        $('#password-again-error').addClass('help-block');
                        $("#password-again-error").text('Password mismatch.');
                    }
                }).on('focusin','#password-again',function(){
                    $("#password-again-group").removeClass('has-error');
                    $("#password-again-error").text('');
                });

                $('#ajax').on('blur','#email', function(){
                    var email = $('#email').val();
                    if(email.trim() == ""){
                        $("#email-group").addClass('has-error');
                        $('#email-error').addClass('help-block');
                        $("#email-error").text('The password field is required.');
                    }
                })                  
                .on('focusin','#email',function(){
                    $('#email-group').removeClass('has-error');
                    $("#email-error").text('');
                });
            }
        });
    }); 
});

function register(e) {

    e.preventDefault();
    var formData = new FormData();
    formData.append('username',$('#username').val());
    formData.append('password',$('#password').val());
    formData.append('password-again',$('#password-again').val());
    formData.append('email',$('#email').val());
    formData.append('account',$('#account:checked').val());

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });

    $.ajax({
        method: 'post',
        url: 'register',
        processData: false,
        contentType: false,
        dataType: 'json',
        data: formData,
        beforeSend: function(){
            $('#signup-btn').html('Please Wait <i class="fa fa-spinner fa-spin"></i>');
            },
        success:function(data){
            $('#signup-btn').html('Create Account');

            if(!data.success){

                $(".error").text("");

                console.log(data.errors);

                $.each(data.errors, function(index,error){
                    console.log(index + '='+ error);
                    $('#'+index+'-group').addClass('has-error');
                    $('#'+index+'-error').addClass('help-block');
                    $('#'+index+'-error').text(error);
                });
            }else{
                //console.log(data.route);
                window.location.href = data.route;
            }
        },
        error:function(){}
    });
}