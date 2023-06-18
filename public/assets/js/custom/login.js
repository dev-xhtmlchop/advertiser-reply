$(document).ready(function(){
    var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
    var URL = $("meta[name='web-url']").attr('content');
    $("#login_form #user_name").on("keyup change", function(e){
        var userName = $(this).val();
        $.ajax({
            url: URL+"/post-login-user",
            type: 'POST',
            data: {_token: CSRF_TOKEN, user_name: userName},
            success: function(response){
                if( response != 1 ){
                   $("#user_name-error").text(response);
                   $("#user_name").removeClass("is-valid").addClass("is-invalid");
                   return false;
                }
            }
        });
    });
    
    $("#login_form").validate({
        rules: {
            user_name: {
                required: true,
            },
            password: {
                required: true,
            },
            media: {
                required: true,
            },
        },
        messages: {
            user_name: {
                required: "Please enter User Name.",
            },
            password: {
                required: "Please enter Password.",
            },
            media: {
                required: "Please select Media Line",
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
                url: URL+"/post-login",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    if( response.status == 0 ){
                        error( response.message, response.class );
                        return false;
                    }else{
                        success( response.message );
                        setTimeout(function(){
                            window.location.href = URL;
                        },500);
                        return true;
                    }
                }            
            });
        }
    });
});