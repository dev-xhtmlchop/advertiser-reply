$(document).ready(function(){
    var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
    var userId = $("#forgot_password #user_id").val();
    $("#current_password").on("keyup change", function(e){
        var curPass = $(this).val();
        $.ajax({
            url: '/currentpassword',
            type: 'POST',
            data: {_token: CSRF_TOKEN, current_password: curPass, user_id: userId},
            success: function(response){
                if( response != 1 ){
                    $("#forgot_password .message").text(response)
                }else{
                    $("#forgot_password .message").empty();
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
            description: {
                required: "Please enter message",
            },
        },
        submitHandler: function(form) {
            $.ajax({
                url: "/post-changepassword",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    console.log( response.message )
                    $("#forgot_password .message").text(response.message);
                    return true;
                }            
            });
        }
    });
});