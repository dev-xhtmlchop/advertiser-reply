var URL = $("meta[name='web-url']").attr('content');
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var STORAGE = $('meta[name="storage-path"]').attr('content');

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
function checkedCheckbox( fieldName, fieldValue ){
  if( fieldValue == 1 ){
      $(fieldName).attr('checked',true);
  }else{
      $(fieldName).attr('checked',false);
  }
}

function dataAppend( fieldName, fieldValue ){
  $(fieldName).empty().append(fieldValue);
}

function dataValue( fieldName, fieldValue ){
  $(fieldName).val(fieldValue);
}
function sucessNotification( message ){
  $(".alert-notification-success .success-message").empty().text(message);
  $(".alert-notification-success").show('medium');
  setTimeout(function(){
    $(".alert-notification-success").hide('medium');
  }, 5000);
  $(".sendButton .close").click(function(){
      $(".alert-notification-success").hide('medium');
  });
}
/*
var timer2 = "02:00";
var interval = setInterval(function() {
  var timer = timer2.split(':');
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10); --seconds;
  minutes = (seconds < 0) ? --minutes : minutes;
  if (minutes < 0) clearInterval(interval);
  seconds = (seconds < 0) ? 59 : seconds;
  seconds = (seconds < 10) ? '0' + seconds : seconds;
  //minutes = (minutes < 10) ?  minutes : minutes;
  console.log(minutes + ':' + seconds);
  timer2 = minutes + ':' + seconds;
}, 1000);
*/
function countdown( timer2 = null) {
  var interval = setInterval(function() {
    var timer = timer2.split(':');
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10); --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    if (minutes < 0) clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds; 
    var timerText = minutes + ':' + seconds;
    if( timerText != '-1:59' ){
      $('.email-time .counter').empty().append(timerText);
    }
    if( ( seconds == '00' ) && ( minutes == '0' ) ){
      $('#email_send_otp').show();
      $('#email_send_otp').css({'pointer-events': 'auto','cursor': 'pointer','opacity': '1'});
    }
    timer2 = minutes + ':' + seconds;
  }, 1000);
}

function errorNotification( message ){
  $(".alert-notification-error .error-message").empty().text(message);
  $(".alert-notification-error").show('medium');
  setTimeout(function(){
    $(".alert-notification-error").hide('medium');
  }, 5000);
  $(".sendButton .close").click(function(){
      $(".alert-notification-error").hide('medium');
  });
}
function uniqueArray(list) {
  var result = [];
  $.each(list, function(i, e) {
      if ($.inArray(e, result) == -1) result.push(e);
  });
  return result;
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
    
    $('.bars-icon').click(function() {
      $('body').toggleClass('header-resize');
      $('body').toggleClass('body-resize');
    });
    $('.navbar-sidebar ul li').mouseover(function(){
        $('body').addClass('hover-resize');
    });
    $('.navbar-sidebar ul li').mouseout(function(){
        $('body').removeClass('hover-resize');
    });
    $(".dropdown-close").click(function(){
      $(".account-item").removeClass("show-dropdown");
   });
});