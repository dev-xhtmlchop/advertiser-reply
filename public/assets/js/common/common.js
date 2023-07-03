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
    $('.campaign-edit .tab-btn').click(function(e){
      e.preventDefault();
      var tabClass = $(this).attr('attr-active'); 
      $('ul.nav-tabs li a').each(function(){
          $(this).removeClass('active').attr('aria-selected', false);
      });
      $('#'+tabClass).addClass('active').attr('aria-selected', true);;

      $('#content .tab-pane').each(function(){
          $(this).removeClass('show').removeClass('active');
      });
      $('.'+tabClass+'-tab').addClass('show').addClass('active');
     // getCampaignDetail();
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
});