/* 
 * © Belgrade Luxury 2017
 * All rights reserved
 */

/*******************************************************************************
 * 
 *                  HIDE jQuery mobile LOADING
 *  
 ******************************************************************************/
$( document ).on( "mobileinit", function() {
    $.mobile.loading( "hide" );
});

$( document ).on( "pageinit", function( event ) {
  $.mobile.loading().hide();
});

/*******************************************************************************
 * 
 *                  ANIMSITION (page loading)
 *  
 ******************************************************************************/
$(document).ready(function() {
  $(".animsition").animsition({
    inClass: 'fade-in-down-sm',
    outClass: 'fade-out-down-sm',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
});

/*******************************************************************************
 * 
 *                  MENU
 *  
 ******************************************************************************/
$(window).on("load", function() {
    // responsive menu
    var pull = $('#pull');
    menu = $('ul.top-nav-menu');
    menuHeight  = menu.height();
 
    $(pull).on('click', function(e) {
      e.preventDefault();
      if (menu.is(':hidden'))
          $('.ha-header').css("background", "rgb(2,2,2)");
      else {
          $('.ha-header').removeAttr('style');
          $('.ha-header').css("display", "block");
      }
      menu.slideToggle();

    });
  
    // toggle submenus
    var services = $('#services');
    s_submenu = $('#services-submenu');
    $(services).on({
        mouseenter: function () {
            s_submenu.slideToggle();
        },
        mouseleave: function () {
            s_submenu.slideToggle();
        }
    });    
    var places = $('#places');
    p_submenu = $('#places-submenu');
    $(places).on({
        mouseenter: function () {
            p_submenu.slideToggle();
        },
        mouseleave: function () {
            p_submenu.slideToggle();
        }
    });
});

/*
$(window).on("resize", function(){
    var w = $(window).width();
    if (w > 320) {
        //menu.hide();
        if (menu.is(':hidden'))
            menu.removeAttr('style');
    } /*else if (w > 767) {
        $('.ha-header').removeAttr('style');
        $('.ha-header').css("display", "block");
        if (!menu.is(':hidden'))
            menu.hide();
        
        //$('.ha-header').css("background", "rgba(253,253,253,0.8)");
    }*/
//}); 



