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

//
// Contains or spreads the video depending on the screen resolution
//
$(window).on("load", function() {
    var height = window.innerHeight;
    var width = window.innerWidth;
    
    if (height < width*0.5625) {
        $('.video-section').addClass('widescreen');
    } else {
        $('.video-section').addClass('contain');
    }
});
$(window).on("resize", function() {
    var height = window.innerHeight;
    var width = window.innerWidth;
    
    if (height < width*0.5625) {
        $('.video-section').removeClass('contain');
        $('.video-section').addClass('widescreen');
    } else {
        $('.video-section').removeClass('widescreen');
        $('.video-section').addClass('contain');
    }
});

//
// Manages YT API
//
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