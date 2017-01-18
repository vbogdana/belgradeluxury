@extends('layouts.master')

@section('content')

<section id="video" class="video-section">
    <iframe frameborder="0" scrolling="no" seamless="seamless" webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" id="player" src='https://www.youtube.com/embed/L0UH4iz6o0Y?enablejsapi=1&rel=0&playsinline=1&autoplay=1&showinfo=0&autohide=1&controls=0&loop=1&modestbranding=1&playlist=L0UH4iz6o0Y'></iframe>      
    <div class='overlay'></div>
    
    <div class="box-right"></div>
       
    <div class="hero-holder">
    <div class="hero-inner">
        <!--
        <h1 class="overlay-text-row" > VIP Experience - Belgrade Nightlife </h1> 
        <div class="horizontal-line"></div>
        <h2 class="overlay-text-row quotes"> BELGRADE <span> LUXURY </span> </h2>
        <h2 class="overlay-text-row quotes"> LUXURY <span> APARTMENTS </span> </h2>
        <h2 class="overlay-text-row quotes"> <span> HIGH CLASS </span> VEHICLES </h2>
        <h2 class="overlay-text-row quotes"> BELGRADE <span> LUXURY </span> </h2>
        <h2 class="overlay-text-row quotes"> EXCLUSIVE <span> PARTIES </span> </h2>
        <h2 class="overlay-text-row quotes"> <span> VIP </span> TABLES </h2>
         -->
        <h1 class="overlay-text-row" > VIP Experience - Belgrade Nightlife </h1> 
        <div class="horizontal-line"></div>
        <h2 class="overlay-text-row"> LUXURY <span> APARTMENTS </span> </h2>
    </div>
    </div>
   <!--
    <div class="scroll-sign">
        <a href="#aboutus">
            <img src="<?php echo url("") ?>/images/3-diamonds.png" />
        </a>
    </div>
   -->
</section>

<section id="aboutus" class="widescreen">
    HELLO
</section>
@stop

@section('scripts')
<script src="js/video.js"></script>
<script src="js/home.js"></script>
@stop

