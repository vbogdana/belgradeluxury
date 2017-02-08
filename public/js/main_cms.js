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




