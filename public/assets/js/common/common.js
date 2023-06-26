var URL = $("meta[name='web-url']").attr('content');
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function nullNumber(number){
    if( number === null ){
        return 0;
    }else{
        return number;
    }
}
function success( message ){
    $(".alert-notification").show().removeClass('alert-danger').addClass('alert-success');
    $(".alert-notification").show().empty().text(message);
}

function error( message, className ){
    $(".alert-notification").show().removeClass('alert-success').addClass('alert-danger');
    $(".alert-notification").show().empty().text(message);
    if( className !== '' ){
      $('#'+className).removeClass('is-valid').addClass('is-invalid');
    }
}

$(document).ready(function(){
    var menu = $('.js-item-menu');
    var sub_menu_is_showed = -1;

    for (var i = 0; i < menu.length; i++) {
      $(menu[i]).on('click', function (e) {
        e.preventDefault();
        $('.js-right-sidebar').removeClass("show-sidebar");        
        if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
          $(this).toggleClass('show-dropdown');
          sub_menu_is_showed = -1;
        }
        else {
          for (var i = 0; i < menu.length; i++) {
            $(menu[i]).removeClass("show-dropdown");
          }
          $(this).toggleClass('show-dropdown');
          sub_menu_is_showed = jQuery.inArray(this, menu);
        }
      });
    }
    $(".js-item-menu, .js-dropdown").click(function (event) {
      event.stopPropagation();
    });

    $("body,html").on("click", function () {
      for (var i = 0; i < menu.length; i++) {
        menu[i].classList.remove("show-dropdown");
      }
      sub_menu_is_showed = -1;
    });
    /*
    $(".sendButton").click(function(){
        $(".alert").show('medium');
        setTimeout(function(){
          $(".alert").hide('medium');
        }, 5000);
      });
      $(".sendButton .close").click(function(){
          $(".alert").hide('medium');
    });*/
});