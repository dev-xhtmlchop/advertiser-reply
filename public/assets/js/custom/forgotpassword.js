$(document).ready(function(){
    var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
    var URL = $("meta[name='web-url']").attr('content');
    var userId = $("#forgot_password #user_id").val();
    $("#current_password").on("keyup change", function(e){
        var curPass = $(this).val();
        $.ajax({
            url: URL+'/currentpassword',
            type: 'POST',
            data: {_token: CSRF_TOKEN, current_password: curPass, user_id: userId},
            success: function(response){
                console.log( response );
                if( response.status == 0 ){
                    error( response.message, response.class );
                    return false;
                }else{
                    $('.alert-notification').hide();
                    return true;
                }
            }
        });
    });
    
    $.validator.addMethod('alphabet', function (value, element) {
        let regExName = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
        return (regExName.test(value));
    }, 'Password must be 12 characters, at least one uppercase letter, one lowercase letter, one number and one special character!');

    $("#forgot_password").validate({
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
                alphabet: true,
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password",
            },
        },
        messages: {

            current_password: {
                required: "Please enter Current Password.",
            },
            new_password: {
                required: "Please enter New Password.",
            },
            confirm_password: {
                required: "Please enter Confirm Password.",
            },
        },
        errorClass: 'error invalid-feedback',
        highlight: function (element) {
           // $(element).closest('.control-group').removeClass('success').addClass('text-danger');
           $(element).addClass('is-invalid');
           $(element).parent().find('.error').addClass('invalid-feedback');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent().find('.error').addClass('invalid-feedback');
        },
        success: function (element) {
            console.log( $(element).parent().find('.form-control') );
            $(element).parent().find('.form-control').removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            $.ajax({
                url: URL+"/post-changepassword",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    console.log( response );
                    if( response.status == 0 ){
                        error( response.message, response.class );
                        return false;
                    }else{
                        success( response.message );
                        return true;
                    }
                }            
            });
        }
    });
});