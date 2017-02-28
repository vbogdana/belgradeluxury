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
 *                          SMOOTH SCROLL INIT
 *  
 ******************************************************************************/
$(window).on("load", function() {
    smoothScroll.init({
        selector: '[data-scroll]', // Selector for links (must be a class, ID, data attribute, or element tag)
        selectorHeader: null, // Selector for fixed headers (must be a valid CSS selector) [optional]
        speed: 500, // Integer. How fast to complete the scroll in milliseconds
        easing: 'easeInOutCubic', // Easing pattern to use
        offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
        callback: function ( anchor, toggle ) {} // Function to run after scrolling
    });
});

/*******************************************************************************
 * 
 *                         SCROLLIFY INIT
 *  
 ******************************************************************************/
$(document).ready(function() {
    if( !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ) {
        $(function() {
            $.scrollify({
                    section : ".panel",
                    interstitialSection : ".interstitial",
                    easing: "easeOutExpo",
                    scrollSpeed: 1500,
                    offset : 0,
                    scrollbars: true,
                    standardScrollElements: "",
                    setHeights: false,
                    overflowScroll: true,
                    updateHash: false,
                    touchScroll:false,
                    before:function() {},
                    after:function() {},
                    afterResize:function() {},
                    afterRender:function() {}
            });
        });
    }
});

/*******************************************************************************
 * 
 *                  MENU MOBILE TOOLBAR EXPANDING
 *  
 ******************************************************************************/
$(window).on("load", function() {
    function toggleToolbar(ev) {
        //ev.preventDefault();
        if ($('.menu.wrapper').attr("expanded") == "false") {
            $('.menu.wrapper').addClass("expanded");
            $('.menu.wrapper').attr("expanded", true);
            $('.toolbar--show i').removeClass('fa-angle-down');
            $('.toolbar--show i').addClass('fa-angle-up');
        } else {
            $('.menu.wrapper').removeClass("expanded");
            $('.menu.wrapper').attr("expanded", false);
            $('.toolbar--show i').removeClass('fa-angle-up');
            $('.toolbar--show i').addClass('fa-angle-down');
        }
    }
    
    $('.toolbar .toolbar--show').on({
        click: toggleToolbar,
        swipe: toggleToolbar            
    });
});

$(window).on("resize", function() {
    var width = window.innerWidth;
    
    if (width >= 768) {
        $('.menu.wrapper').removeClass("expanded");
        $('.menu.wrapper').attr("expanded", false);
        $('.toolbar--show i').removeClass('fa-angle-up');
        $('.toolbar--show i').addClass('fa-angle-down');
    }       
});




