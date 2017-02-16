/* 
 * © Belgrade Luxury 2017
 * All rights reserved
 */

/*******************************************************************************
 * 
 *                  SETUP VIDEO
 *  
 ******************************************************************************/
/*
//
// Inits FitVids.js
//
jQuery(document).ready(function(){
    "use strict";
  // FitVides Option
  jQuery("html").fitVids();
 
});
*/

/*******************************************************************************
 * 
 *        Contains or spreads the video depending on the screen resolution
 *  
 ******************************************************************************/
$(document).ready(function() {
    var height = window.innerHeight;
    var width = window.innerWidth;
    
    if (width < 768) {
        $('.video-section').addClass('widescreen');
    } else {
        //$('.video-section #content').html('<iframe frameborder="0" scrolling="no" seamless="seamless" webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" id="player" src="https://www.youtube.com/embed/L0UH4iz6o0Y?enablejsapi=1&rel=0&playsinline=1&autoplay=1&showinfo=0&autohide=1&controls=0&loop=1&modestbranding=1&playlist=L0UH4iz6o0Y"></iframe>');
        if (height < width*0.5625) {
            $('.video-section').addClass('widescreen');
        } else {
            $('.video-section').addClass('contain');
        }
    }
});
$(window).on("resize", function() {
    var height = window.innerHeight;
    var width = window.innerWidth;
    
    if (width < 768) {
        $('.video-section').removeClass('contain');
        $('.video-section').addClass('widescreen');
    } else {
        result = $('.video-section #content').find('iframe');
        if (result.length > 0) {
            if (height < width*0.5625) {
                $('.video-section').removeClass('contain');
                $('.video-section').addClass('widescreen');
            } else {
                $('.video-section').removeClass('widescreen');
                $('.video-section').addClass('contain');
            }
        }
    }
});

/*******************************************************************************
 * 
 *                         MANAGES YOUTUBE API
 *  
 ******************************************************************************/
// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    events: {
      'onReady': onPlayerReady
    }
  });
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    event.target.mute();
    event.target.setVolume(0);
    event.target.playVideo(); 
}