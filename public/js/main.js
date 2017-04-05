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
$(document).ready(function () {
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
        browser: ['animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'body',
        transition: function (url) {
            window.location.href = url;
        }
    });
});

/*******************************************************************************
 * 
 *                          ANIMATIONS INIT
 *  
 ******************************************************************************/
$(document).ready(function () {
    
    var topOfWindow = $(window).scrollTop();
    var bottomOfWindow = topOfWindow + $(window).innerHeight();
    /*
     * Initializes elements that are to be animated
     * 
     * @param {HTML DOM object} el
     * @returns {undefined}
     */
    function addAnimated(el, animation) {
        el.addClass('animated');            
        var imagePos = el.offset().top;

        if (imagePos < bottomOfWindow && imagePos >= topOfWindow) {
            el.addClass(animation);
        } else {
            el.addClass('hideIt');
        }
    }
    /*
     * Adds animation to element
     * 
     * @param {HTML DOM object} el
     * @param {string} animation
     * @param {int} offset
     * @returns {undefined}
     */
    function addAnimation(el, animation, offset) {
        var imagePos = el.offset().top;

        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + offset) {
            el.removeClass('hideIt');
            el.addClass(animation);
        }
    }

    $(window).on("load", function () { 
        var i = 700;
        // add animations to opening elements
        $('section:first-of-type .description h1, '
        + 'section:first-of-type .description h2:not(.vertical-tabs .tab-content h2) ').each(function () {
            $(this).addClass('animated');
            $(this).addClass('fadeInDown');
            $(this).css("animation-delay", i + "ms");
        });
        i = 0;
        $('.vertical-tabs ul.nav-pills li').each(function () {
            $(this).addClass('animated');
            $(this).addClass('fadeInLeft');
            $(this).css("animation-delay", i + "ms");
            i += 100;
        });


        // add animations to elements
        $('.gold-ornament').each(function () {
            addAnimated($(this), 'fadeInUp');
        });
        $('.gold-decor').each(function () {
            addAnimated($(this), 'fadeIn');
        });           
        $('.description h2:not(.hero-holder .description h2, .vertical-tabs .tab-content h2)').each(function() {
            addAnimated($(this), 'fadeInDown');
        });
        $('.vertical-tabs .tab-content h2').each(function() {
            addAnimated($(this), 'fadeIn');
        });
        $('.description p:not(.hero-holder .description p)').each(function () {
            addAnimated($(this), 'fadeIn');
        }); 
        $('.aboutus-section .block').each(function () {
            addAnimated($(this), 'fadeInUp');
        });
        i = 0;
        $('ul.nav-pills li').each(function () {
            addAnimated($(this), 'fadeInDown');
            $(this).css("animation-delay", i + "ms");
            i += 100;
        });        
        $('.side-photo').each(function () {
            addAnimated($(this), 'fadeInDown');
        });
        $('.side-content').each(function () {
            addAnimated($(this), 'fadeIn');
        });
        $('.row-list .content').each(function () {
            addAnimated($(this), 'fadeIn');
        });
        $('.contact-section .hi-icon').each(function () {
            addAnimated($(this), 'fadeIn');
        });
        $('.vertical-tabs .tab-content .hi-icon').each(function() {
            addAnimated($(this), 'fadeIn');
        });
        i = 0;
        $('.social .hi-icon').each(function () {
            addAnimated($(this), 'fadeInUp');
            $(this).css("animation-delay", i + "ms");
            i += 100;
        });

    });

    $(window).on("scroll", function () {
        var windowHeight = $(window).innerHeight();

        $('.gold-ornament.animated').each(function() {
            addAnimation($(this), "fadeInUp", windowHeight - 100);
        });
        $('.gold-decor.animated').each(function() {
            addAnimation($(this), "fadeIn", windowHeight - 100);
        });
        $('.description h2.animated:not(.vertical-tabs .tab-content h2)').each(function() {
            addAnimation($(this), "fadeInDown", windowHeight - 100);
        });
        $('.vertical-tabs .tab-content h2').each(function() {
            addAnimation($(this), 'fadeIn', windowHeight - 100);
        });
        $('.description p.animated').each(function() {
            addAnimation($(this), "fadeIn", windowHeight - 100);
        });
        var i = 0;
        $('.aboutus-section .block.animated').each(function() {
            addAnimation($(this), "fadeInUp", $('.aboutus-section').height() - 50);
            $(this).css("animation-delay", i + "ms");
            i += 100;
        });
        i = 0;
        $('ul.nav-pills li').each(function () {
            addAnimation($(this), "fadeInDown", windowHeight - 100);
            $(this).css("animation-delay", i + "ms");
            i += 100;
        });
        $('.side-photo').each(function () {
            addAnimation($(this), 'fadeInDown', windowHeight - 100);
        });
        $('.side-content').each(function () {
            addAnimation($(this), 'fadeIn', windowHeight - 100);
        });
        $('.row-list .content').each(function () {
            addAnimation($(this), 'fadeIn', windowHeight - 100);
        });
        $('.contact-section .hi-icon').each(function() {
            addAnimation($(this), "fadeIn", windowHeight - 100);
        });
        $('.vertical-tabs .tab-content .hi-icon').each(function() {
            addAnimation($(this), 'fadeIn', windowHeight - 100);
        });
        i = 0;
        $('.social .hi-icon').each(function () {
            addAnimation($(this), "fadeInUp", windowHeight - 10);
            $(this).css("animation-delay", i + "ms");
            i += 100;
        });
    });

    if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))) {
        
        $(window).on("load", function () { 
            // add animations to opening elements
            var i = 700;
            $('#navbar ul.nav li a.animated').each(function () {
                $(this).addClass('fadeInDown');
                $(this).css("animation-delay", i + "ms");
                i += 200;               
            });
            i = 700;
            $('section:first-of-type .box-left, '
            + 'section:first-of-type .box-right, '
            + 'section.contact-section:first-of-type .hero-inner').each(function () {
                $(this).addClass('animated');
                $(this).addClass('zoomIn');
                $(this).css("animation-delay", i + "ms");
            });
        });

        // add animations to panels
        $('.box-right:not(.video-section .box-right, .service-description-section .box-right), '
        + '.box-left:not(.service-description-section .box-left)').each(function () {
            addAnimated($(this), 'zoomIn');
        });
    }
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
                    before:function(i, panels) {
                        $left = panels[i].find('.box-left.animated');
                        $left.removeClass('hideIt');
                        $right = panels[i].find('.box-right.animated');
                        $right.removeClass('hideIt');
                        $left.addClass("zoomIn");
                        $right.addClass("zoomIn");
                    },
                    after:function(i, panels) {  
                    },
                    afterResize:function() {},
                    afterRender:function() {}
            });
        });
        /*
        $('a[data-scroll]').each(function () {           
            $(this).on('click', function(ev) {
                ev.preventDefault();                
                href = $(this).attr('href');
                page = href.substr(0, href.indexOf('#'));
                anchor = href.substr(href.indexOf('#'));
                if (page == "" || window.location == page) {
                    anchor += '-panel';
                    $.scrollify.move(anchor);
                } else {                   
                    window.location = page + anchor;
                }
            });
        });
         */
    } else {       
             
    }
});

/*******************************************************************************
 * 
 *                  SMOOTH SCROLL INIT
 *  
 ******************************************************************************/
$(window).on("load", function(ev) {
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




