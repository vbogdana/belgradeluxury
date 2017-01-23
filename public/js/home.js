/* 
 * © Belgrade Luxury 2017
 * All rights reserved
 */

/*******************************************************************************
 * 
 *                          CHANGING QUOTES
 *  
 ******************************************************************************/
/* changing quotes on video */
$(window).on("load", function() {
    var quotes = $(".quotes");
    var quoteIndex = -1;

    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(1000)
            .delay(3000)
            .fadeOut(1000, showNextQuote);
    }

    showNextQuote();
});

/* changing quotes on quote section */
/*
$(window).on("load", function() {
    var quotes = $(".blockquotes");
    var quoteIndex = -1;

    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(1000)
            .delay(3000)
            .fadeOut(1000, showNextQuote);
    }

    showNextQuote();
});
*/

/*******************************************************************************
 * 
 *                         SCROLLIFY INIT
 *  
 ******************************************************************************/
$(window).on("load", function() {
    $(function() {
        $.scrollify({
                section : ".panel",
                interstitialSection : ".video-section, .aboutus-section.ribbon",
                easing: "easeOutExpo",
		scrollSpeed: 2000,
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
});


/*******************************************************************************
 * 
 *                         CARD REFLECTIONS
 *  
 ******************************************************************************/
$(window).load(function() {    
    var $cards = $('.card');
    $.each($cards, function() {
        var $element = $(this);
        $element.reflect({
            height: 0.5,
            opacity: 0.2
        });
    });
});

/*******************************************************************************
 * 
 *                         PACKAGES SECTION
 *  
 ******************************************************************************/
// checking media
var isLaptop = false;
var isTablet = false;
var isMobile = false;
//var ids = { id: ["front", "right-front", "right-back", "back", "left-back", "left-front"] };
var translateD = { value: ["0, 0, 0", "440px, 0, -20px", "240px, 0, -40px", "0, 0, -60px", "-240px, 0, -40px", "-440px, 0, -20px"] };
var scaleD = { value: ["1", "0.65", "0.4", "0.25", "0.4", "0.65"] };
var translateL = { value: ["0, 0, 0", "270px, 0, -20px", "135px, 0, -40px", "0, 0, -60px", "-135px, 0, -40px", "-270px, 0, -20px"] };
var scaleL = { value: ["0.78", "0.58", "0.3", "0.2", "0.3", "0.58"] };
var translateT = { value: ["0, 0, 0", "270px, 0, -20px", "135px, 0, -40px", "0, 0, -60px", "-135px, 0, -40px", "-270px, 0, -20px"] };
var scaleT = { value: ["1", "0.9", "0.8", "0.7", "0.8", "0.9"] };
var opacity = { value: ["1", "1", "0.9", "0.9", "0.9", "1"] };
var $center_figure;

function checkMedia() {
    isLaptop = false;
    isTablet = false;
    isMobile = false;
    if (window.matchMedia) {
        isLaptop = window.matchMedia('(min-width: 768px)').matches;
        isLaptop = isLaptop && window.matchMedia('(max-width: 1120px)').matches;
        if (!isLaptop) {
            isTablet = window.matchMedia('(max-width: 767px)').matches;
            isTablet = isTablet && window.matchMedia('(min-width: 451px)').matches;
            if (!isTablet)
                isMobile = window.matchMedia('(max-width: 450px)').matches;
        }
    } else {
        isLaptop = screen.width >= 768 && screen.width <= 1120 ;
        if (!isLaptop) {
            isTablet = screen.width > 450 && screen.width < 768;
            if (!isTablet)
                isMobile = screen.width <= 450;
        }
    }
}

function showPackageInfo() {
    $('#package-title').css("opacity", "0");
    var $package = $('figure#0').attr("class");
            
    $('#package-title').delay(500).queue(function (next) {
        switch ($package) {
            case "luxury": $('#package-title').html("LUXURY PACKAGE"); break;
            case "vip-luxury": $('#package-title').html("VIP LUXURY PACKAGE"); break;
            case "bachelor-luxury": $('#package-title').html("BACHELOR LUXURY PACKAGE"); break;
            case "bachelor-penthouse": $('#package-title').html("BACHELOR PENTHOUSE PARTY"); break;
            case "new-year-luxury": $('#package-title').html("NEW YEAR LUXURY PACKAGE"); break;
            case "new-year-vip-luxury": $('#package-title').html("NEW YEAR VIP LUXURY PACKAGE"); break;            
        }
        $('#package-title').css("opacity", "1");
        next();
    });     
}
    
$(window).on("resize", function() {
   checkMedia();
   var figures = $('#carousel figure');
   $.each(figures, function() {
        var $element = $(this);
        var $id = parseInt($element.attr("id"));
        if (isMobile || isTablet) {
            // TO DO mobile & tablet
            $element.css({
                "-webkit-transform": "translate3d(" + translateD.value[$id] + ") scale(" + scaleD.value[$id] + ")",
                "transform": "translate3d(" + translateD.value[$id] + ") scale(" + scaleD.value[$id] + ")",
                opacity: "1"
            });
        } else if (isLaptop) {
            $element.css({
                "-webkit-transform": "translate3d(" + translateL.value[$id] + ") scale(" + scaleL.value[$id] + ")",
                "transform": "translate3d(" + translateL.value[$id] + ") scale(" + scaleL.value[$id] + ")",
                opacity: opacity.value[$id]
            });    
        } else {
            $element.css({
                "-webkit-transform": "translate3d(" + translateD.value[$id] + ") scale(" + scaleD.value[$id] + ")",
                "transform": "translate3d(" + translateD.value[$id] + ") scale(" + scaleD.value[$id] + ")",
                opacity: opacity.value[$id]
            });
        }
    });
});


$(window).on("load", function() {
    
    // flip on hover
    var $front = $('.flip-container .flipper .front .card img');
    $front.on({
        mouseenter: function() {
            //ev.preventDefault();
            var $flipper = $(this).closest(".flipper");
            if ($flipper.closest("figure").attr("id") == 0) {
                if (isTablet || isMobile) {
                    $flipper.css({
                        "-webkit-transform" : "rotateY(-180deg)",
                        transform: "rotateY(-180deg)"
                    });
                } else {
                    $flipper.css({
                        "-webkit-transform" : "rotateY(-180deg)",
                        transform: "rotateY(-180deg)"  //+  "scale(1.3) translateX(40px)"
                    });
                }
            }
        }
    });
    
    // flip back on mouseleave
    var $back = $('.flip-container .flipper .back');
    $back.on({
        mouseleave: function() {
            var $flipper = $(this).closest(".flipper");
            if ($flipper.closest("figure").attr("id") == 0) {
                $flipper.css({
                    "-webkit-transform" : "rotateY(0deg)",
                    transform: "rotateY(0deg)"
                });
            }
        }
    });   
});

// rotate ring
$(window).on("load", function() {
    
    checkMedia();
    var $figures = $('#carousel figure');
    
    $('#inquiry').on('click', function(ev) {
        ev.preventDefault();
        window.location.href = "under-construction";
    });
    
    $('#details').on('click', function(ev) {
        ev.preventDefault();
        var $package = $('figure#0').attr("class");
        //window.location.href = "{{ URL::to('packages/" + $package + "') }}";
        window.location.href = "packages/" + $package + "-package";
    });
    
    // FOR TABLETS AND MOBILES
    $('.next-btn').on('click', swipeleftHandler);   
    $('.previous-btn').on('click', swiperightHandler);
    $('.carousel-container').on('swipeleft', swipeleftHandler);   
    $('.carousel-container').on('swiperight', swiperightHandler);
    
    function swiperightHandler( ev ) {
        ev.preventDefault();
        $.each($figures, function() {
            var $element = $(this);
            var $curr_id = parseInt($element.attr("id"));
            var $new_id = ($curr_id + 1) % 6;
            $element.attr("id", $new_id);
            if ($new_id == 0) {
                $element.find('.front').removeClass("floating");
                $element.find('.front').removeClass("floating" + $curr_id);
            } else {
                $element.find('.front').addClass("floating");
                $element.find('.front').addClass("floating" + $new_id);
            }
            
            $element.css({
                "-webkit-transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                "transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                opacity: opacity.value[$new_id]
            });                                      
        });
        showPackageInfo();
    }
    
    function swipeleftHandler( ev ){
        ev.preventDefault();
        $.each($figures, function() {
            var $element = $(this);
            var $curr_id = parseInt($element.attr("id"));
            var $new_id = ($curr_id - 1 + 6) % 6;
            $element.attr("id", $new_id);
            //if ($new_id == 0)
            //    $center_figure = $element;
            if ($new_id == 0) {
                $element.find('.front').removeClass("floating");
                $element.find('.front').removeClass("floating" + $curr_id);
            } else {
                $element.find('.front').addClass("floating");
                $element.find('.front').addClass("floating" + $new_id);
            }
            
            $element.css({
                "-webkit-transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                "transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                opacity: opacity.value[$new_id]
            });                                       
        });
        showPackageInfo();
    }
    
    // FOR LAPTOPS AND DESKTOPS
    $('#carousel figure').on('click', function(ev) {
        ev.preventDefault();       
        var id = parseInt($(this).attr("id"));
        var delay_time = 0;
        
        
        if (id == 0) {
            // kliknut sredisnji
            var $flipper = $(this).find(".flipper");
            $flipper.css({
                "-webkit-transform" : "rotateY(180deg)",
                transform: "rotateY(180deg)"
            });
            return;
        }
                
        if (!isMobile && !isTablet) {
            // flip back the center one
            $.each($figures, function() {
                var $element = $(this);
                var $curr_id = parseInt($element.attr("id"));
                if ($curr_id == 0) {
                    var $flipper = $element.find(".flipper");
                    $flipper.css({
                        "-webkit-transform" : "rotateY(0deg)",
                        transform: "rotateY(0deg)"
                    })  
                };
            });
            
            // if need to rotate by 2 cards
            if (id == 2 || id == 4) {           
                $.each($figures, function() {
                    var $element = $(this);
                    var $curr_id = parseInt($element.attr("id"));
                    var $new_id;
                    if (id == 2)
                        $new_id = ($curr_id - 1 + 6) % 6;
                    else if (id == 4)
                        $new_id = ($curr_id + 1) % 6;
                    $element.attr("id", $new_id);
                    if (isLaptop) {
                        $element.css({
                            "-webkit-transform": "translate3d(" + translateL.value[$new_id] + ") scale(" + scaleL.value[$new_id] + ")",
                            "transform": "translate3d(" + translateL.value[$new_id] + ") scale(" + scaleL.value[$new_id] + ")",
                            opacity: opacity.value[$new_id]
                        });    
                    } else {
                        $element.css({
                            "-webkit-transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                            "transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                            opacity: opacity.value[$new_id]
                        });
                    }
                });
                if (id == 2) id = 1;
                if (id == 4) id = 5;
                delay_time = 500;          
            }
            
            // rotate by one card
            $.each($figures, function() {
                var $element = $(this);
                var $curr_id = parseInt($element.attr("id"));
                var $new_id = ((6 - id) + $curr_id) % 6;
                //if ($new_id == 0)
                //    $center_figure = $element;
                
                if ($new_id == 0) {
                    $element.find('.front').removeClass("floating");
                    $element.find('.front').removeClass("floating" + $curr_id);
                } else {
                    $element.find('.front').addClass("floating");
                    $element.find('.front').addClass("floating" + $new_id);
                }
                $element.attr("id", $new_id);
                $element.delay(delay_time).queue(function (next) { 
                    if (isLaptop) {
                        $element.css({
                            "-webkit-transform": "translate3d(" + translateL.value[$new_id] + ") scale(" + scaleL.value[$new_id] + ")",
                            "transform": "translate3d(" + translateL.value[$new_id] + ") scale(" + scaleL.value[$new_id] + ")",
                            opacity: opacity.value[$new_id]
                        });
                    } else {
                        $element.css({
                            "-webkit-transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                            "transform": "translate3d(" + translateD.value[$new_id] + ") scale(" + scaleD.value[$new_id] + ")",
                            opacity: opacity.value[$new_id]
                        });
                    }
                    next(); 
                });                        
            });
            showPackageInfo();
        }      
    });
});