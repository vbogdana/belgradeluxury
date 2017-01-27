@extends('layouts.master')

@section('stylesheets')
<link href="css/slick.css" rel="stylesheet" type="text/css">
<link href="css/slick-theme.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<!--    START VIDEO SECTION      -->
<section id="video" class="video-section background-properties" data-section-name="intro">
    <div id="content">
        <!--<iframe frameborder="0" scrolling="no" seamless="seamless" webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" id="player" src='https://www.youtube.com/embed/L0UH4iz6o0Y?enablejsapi=1&rel=0&playsinline=1&autoplay=1&showinfo=0&autohide=1&controls=0&loop=1&modestbranding=1&playlist=L0UH4iz6o0Y'></iframe>      
        -->
    </div>   
    <div class='overlay'></div>
    
    <div class="box-right">
        <div class="hero-holder">
            <div class="hero-inner text-center">
                <div class="hero-text">
                    <div class='logo center-block text-center'>
                        <img class="img-responsive" src='<?php echo url("/")?>\images\logo\logo.svg'>
                    </div>
                    <h2 class="quotes"> BELGRADE <span> LUXURY </span> </h2>
                    <h2 class="quotes"> LUXURY <span> APARTMENTS </span> </h2>
                    <h2 class="quotes"> <span> HIGH CLASS </span> VEHICLES </h2>
                    <h2 class="quotes"> BELGRADE <span> LUXURY </span> </h2>
                    <h2 class="quotes"> EXCLUSIVE <span> PARTIES </span> </h2>
                    <h2 class="quotes"> <span> VIP </span> TABLES </h2>
                    <h1> VIP Experience - Belgrade Nightlife </h1> 
                    <p> Simply Be Lux. </p>                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--    END VIDEO SECTION      -->

<!--    START ABOUT US SERVICES SECTION      -->
<section id="aboutus-ribbon" class="aboutus-section ribbon fullwidth space-y" data-section-name="services">            
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">LUXURY VIP SERVICE</h2>
            <a id="contact" class="btn"> CONTACT US </a>
            <p class="">
                Belgrade Luxury is a unique concept, established in 2016 in Belgrade, designed exclusively for people with exquisite taste who want the quality of their visit to the capital of Serbia to be to the highest of standards. Our mission is to satisfy the most demanding wishes of our clients and do everything to make their stay in Belgrade according to their preferences.
            </p>           
        </div>    
    </div>
    <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
    
    <div class="text-center text-uppercase">
        <div class="block">
            <a href="#">
                <h3>accommodation</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>vehicles</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>chauffeur</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>host</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>security</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>reservations</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>events</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>nightlife</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>sightseeing</h3>
            </a>
        </div>
        <div class="block">
            <a href="#">
                <h3>diamond</h3>
            </a>
        </div>
    </div>
</section>
<!--    END ABOUT US SERVICES SECTION      -->

<!--    ABOUT US PANEL 1 SECTION      -->
<section id="aboutus-panel-1" class="aboutus-section panel widescreen background-properties" data-section-name="about-us">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">About us</h2>
                    <p>
                        We offer the most exclusive villas and suites, VIP treatment in the city's best restaurants, bars and clubs, personal chauffeur service and luxury vehicles, personal security, boat tours of the city, accompanied by a personal guide and trips to the most interesting sites in Serbia. 
                    </p>
                    <p>
                        And for our most demanding clients we provide DIAMOND services such as - renting a penthouse, a luxury villa or a yacht and many more.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    END ABOUT US PANEL 1 SECTION      -->

<!--    ABOUT US PANEL 2 SECTION      -->
<section id="aboutus-panel-2" class="aboutus-section panel widescreen background-properties" data-section-name="packets">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">Packages</h2>
                    <p>
                        To help our customers, we have prepared a variety of packages that can meet their different needs and preferences. 
                    </p>
                    <p>
                        Belgrade Luxury packages have derived from our many years of experience encompassing all the necessary services for an unforgettable VIP experience of Belgrade. 
                    </p>
                    <p>
                        Depending on your affinity and intent You can choose one of the packages, but also put together a package tailored to fit your needs, because - The Best Luxury Services Are Customized, Not Standardized.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    END ABOUT US PANEL 2 SECTION      -->

<!--    START PACKAGES SECTION      -->
<section id="packages" class="packages-section widescreen panel space-y" data-section-name="select-package">
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> packages </h2>
            <p>
                These are our special packages that we have prepared for You. 
                Each one has been carefully selected by 
                <a href="<?php echo url('/') ?>" class="">BELGRADE LUXURY</a> 
                team to meet all of Your needs.
                Choose Your favorite, or <a class="" href="<?php echo url('/under-construction') ?>"> create one </a> according to Your taste.
            </p>
        </div>    
    </div>
    <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
        
    <div class="container">
        <div class="description text-center" id="package-info">
            <h4 id="package-title"> LUXURY PACKAGE </h4>
            <a id="inquiry" class="btn"> INQUIRY </a>
            <a id="details" class="btn"> DETAILS </a>
        </div>
    </div>
    
    <div class="packages-container">                                            
        <div class="carousel-container">
            <div class="previous-btn">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            </div>
            <div class="next-btn">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </div>
            <div id="carousel">
                <figure id="0" class="luxury">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <img id="luxury" src="<?php echo url("") ?>/images/cards/front-1.svg" class="card" height="227px" width="363.5px" alt="Luxury Package"/>
                            </div>
                            <div class="back">
                                <img src="<?php echo url("") ?>/images/cards/front-1.svg" class="card" height="227px" width="363.5px" alt="Luxury Package" />
                            </div>
                        </div>
                    </div>                  
                </figure>
                <figure id="1" class="vip-luxury">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front floating floating1">
                                <img id="vip-luxury" src="<?php echo url("") ?>/images/cards/front-2.svg" class="card" height="227px" width="363.5px" alt="VIP Luxury Package"/>
                            </div>
                            <div class="back">
                                <img src="<?php echo url("") ?>/images/cards/front-2.svg" class="card" height="227px" width="363.5px" alt="VIP Luxury Package"/>
                            </div>
                        </div>
                    </div> 
                </figure>
                <figure id="2" class="bachelor-luxury">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front floating floating2">
                                <img id="bachelor-luxury" src="<?php echo url("") ?>/images/cards/front-3.svg" class="card" height="227px" width="363.5px" alt="NEWYEAR Luxury Package" />
                            </div>
                            <div class="back">
                                <img src="<?php echo url("") ?>/images/cards/front-3.svg" class="card" height="227px" width="363.5px"alt="NEWYEAR Luxury Package" />
                            </div>
                        </div>
                    </div> 
                </figure>
                <figure id="3" class="bachelor-penthouse">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front floating floating3">
                                <img id="bachelor-penthouse" src="<?php echo url("") ?>/images/cards/front-4.svg" class="card" height="227px" width="363.5px" alt="Luxury Package" />
                            </div>
                            <div class="back">
                                <img src="<?php echo url("") ?>/images/cards/front-4.svg" class="card" height="227px" width="363.5px"alt="Luxury Package" />
                            </div>
                        </div>
                    </div> 
                </figure>
                <figure id="4" class="new-year-vip-luxury">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front floating floating4">
                                <img id="new-year-vip-luxury" src="<?php echo url("") ?>/images/cards/front-5.svg" class="card" height="227px" width="363.5px" alt="Luxury Package"/>
                            </div>
                            <div class="back">
                                <img src="<?php echo url("") ?>/images/cards/front-5.svg" class="card" height="227px" width="363.5px" alt="Luxury Package"/>
                            </div>
                        </div>
                    </div> 
                </figure>
                <figure id="5" class="new-year-luxury">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front floating floating5">
                                <img id="new-year-luxury" src="<?php echo url("") ?>/images/cards/front-6.svg" class="card" height="227px" width="363.5px" alt="Luxury Package"/>
                            </div>
                            <div class="back">
                                <img src="<?php echo url("") ?>/images/cards/front-6.svg" class="card" height="227px" width="363.5px" alt="Luxury Package" />
                            </div>
                        </div>
                    </div> 
                </figure>
            </div>
        </div>
    </div>
    
    <div class="custom-package-container">
        <div class="container text-center">
            <div class="description">
                <h2 class="text-uppercase"> custom package </h2>
                <p>
                    If You would prefer something a little bit different than services included in our packages, You can always create You own custom package. Put together a package tailored to fit your needs, because - <i> The Best Luxury Services Are Customized, Not Standardized. </i>
                </p>                
            </div>
        </div>
        <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
        <div class="container text-center">
            <div class="text-uppercase">
                <div class="col-sm-4">
                    Choose Your services
                </div>
                <div class="col-sm-4">
                    Set a date for your visit
                </div>
                <div class="col-sm-4">
                    Book!
                </div>
            </div>
        </div>
    </div>
</section>
<!--    END PACKAGES SECTION      -->

<!--    START EVENTS SECTION      -->
<section id="events" class="events-section widescreen panel space-y" data-section-name="events-in-belgrade">
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> BELGRADE </h2>
            <p>

            </p>
        </div>
    </div>
    <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
    
    <div class="container">
        <div class="carousel-holder text-center">
            <div class="events-carousel">
                <div class="slide">
                    <div class="header">
                        <h2>MONDAY</h2>
                        <h3>30.01.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>TUESDAY</h2>
                        <h3>31.01.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>WEDNESDAY</h2>
                        <h3>01.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>THURSDAY</h2>
                        <h3>02.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>FRIDAY</h2>
                        <h3>03.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>SATURDAY</h2>
                        <h3>04.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>SUNDAY</h2>
                        <h3>05.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>MONDAY</h2>
                        <h3>06.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>TUESDAY</h2>
                        <h3>07.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
                <div class="slide">
                    <div class="header">
                        <h2>WEDNESDAY</h2>
                        <h3>08.02.</h3>
                    </div>
                    <div class="content">
                        <div class="img-holder">
                            <img class="img-responsive" src='<?php echo url("/")?>\images\events\boxright3.jpg'>                       
                        </div>
                        <h2>Klub Brankov<br/>druga linija</h2>
                        <h3>naziv zurke<br/> druga linija</h3>
                        <a href="tel:+381644519017">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 064 4519 017
                        </a>
                    </div>
                </div>
            </div>
        </div>        
    </div>

</section>
<!--    END EVENTS SECTION      -->

<!--    START BELGRADE SECTION      -->
<section id="places" class="belgrade-section widescreen panel text-uppercase text-center" data-section-name="belgrade">
    <div class="block">
        <a href="#">
            <h3>
               culture 
            </h3>
        </a>
    </div>
    <div class="block">
        <a href="#">
            <h3>
               society
            </h3>
        </a>
    </div>
    <div class="block">
        <a href="#">
            <h3>
               gastronomy 
            </h3>
        </a>
    </div>
    <div class="block">
        <a href="#">
            <h3>
               nightlife 
            </h3>
        </a>
    </div>
    <div class="center block">
        <a href="#">
            <h3>
               sites
            </h3>
        </a>
    </div>
</section>
<!--    END BELGRADE SECTION      -->
@stop

@section('scripts')
<script src="js/video.js"></script>
<script src="js/jquery.scrollify.min.js"></script>
<script src="js/reflection.js"></script>
<script src="js/slick.js"></script>
<script src="js/home.js"></script>
@stop
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              