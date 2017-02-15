<!DOCTYPE html>
<!--
    Tutorial za Laravel https://laravel.com/docs/5.3/
-->

<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <!-- common meta tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PP3HH9');</script>
        <!-- End Google Tag Manager -->
        
        <!-- page titles and meta tags -->
        @section('title-meta')
        <title>Belgrade Luxury - VIP Experience Belgrade Nightlife</title>
        
        <meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
        <meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
        <meta property="fb:pages" content="belgradeluxury">
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://belgradeluxury.com">
        <meta property="og:title" content="Belgrade Luxury - VIP Experience Belgrade Nightlife" />
        <meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
        <meta property="og:site_name" content="Belgrade Luxury">        
        <meta property="og:image" content='{{ route("/") }}/images/DOPUNI' />   
        @show
        
        <!-- favicons  -->       	      
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url("") }}/images/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="{{ url("") }}/images/icons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ url("") }}/images/icons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="{{ url("") }}/images/icons/manifest.json">
        <link rel="mask-icon" href="{{ url("") }}/images/icons/safari-pinned-tab.svg" color="#ceab4d">
        <link rel="shortcut icon" href="{{ url("") }}/images/icons/favicon.ico">
        <meta name="msapplication-config" content="{{ url("") }}/images/icons/browserconfig.xml">
        <meta name="theme-color" content="#ceab4d">
       
        
        <!-- scripts -->
        <link href="{{ url("") }}/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="{{ url("") }}/css/style.css" rel="stylesheet" type="text/css">
        <link href="{{ url("") }}/css/animsition.min.css" rel="stylesheet" type="text/css">       
        @yield('stylesheets')        
    </head>
    
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PP3HH9"
                    height="0" width="0" style="display:none;visibility:hidden">            
            </iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        
        
        <!-- page content -->
        <div class='animsition'>
            <div class="menu wrapper text-lowercase" expanded="false">
                @section('toolbar')
                <div class='toolbar'>
                    <div class="container">
                        <div class="col-xs-12 col-sm-7 col-md-6">
                            <div class="col-xs-12 col-sm-7">
                                <a href="mailto:inquiry@belgradeluxury.com">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    inquiry@belgradeluxury.com
                                </a>                               
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <a href="tel:+381644519017">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    (+381) 064 4519 017
                                </a>                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-2">
                            <div class="col-xs-4">
                                Language:
                            </div>
                            <div class="col-xs-8">
                                <ul>
                                    <li><a href="#">EN</a></li>
                                    <li><a href="#">SRB</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 toolbar--show text-center">
                            <i class="fa fa-pulse fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                @show
            <!-- menu se definise ovde jer ce biti isti za sve stranice -->
            @section('sidebar')
                <nav class='navbar navbar-fixed-top'>
                    <div class='container'>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ route("/") }}">
                                <img src="{{ url("") }}/images/logo/logo-letters.svg" alt="Belgrade Luxury Logo"/>
                                <span>HOME</span>
                            </a>
                        </div>

                        <div id='navbar' class='navbar-collapse collapse'>
                            <ul class='nav navbar-nav '>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-hover="SERVICES">SERVICES <span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='#'>accommodation</a></li>
                                        <li><a href='#'>vehicles</a></li>
                                        <li><a href='#'>wellness & spa</a></li>
                                        <li><a href='#'>host</a></li>
                                        <li><a href='#'>security</a></li>
                                        <li><a href='#'>reservations</a></li>
                                        <li><a href='#'>events</a></li>
										<li><a href='#'>business</a></li>
										<li><a href='#'>personel</a></li>
                                        <li><a href='#'>nightlife</a></li>
                                        <li><a href='#'>sightseeing</a></li>
                                        <li><a href='#'>diamond</a></li>
                                    </ul>
                                </li>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-hover="PACKAGES">PACKAGES <span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='#'>luxury</a></li>
                                        <li><a href='#'>diamond</a></li>
                                        <li><a href='#'>spa</a></li>
                                        <li><a href='#'>bachelor</a></li>
                                        <li><a href='#'>party</a></li>
                                        <li><a href='#'>business</a></li>
                                        <li><a href='#'>custom package</a></li>
                                    </ul>
                                </li>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-hover="BELGRADE">BELGRADE <span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='#'>restaurants</a></li>
                                        <li><a href='#'>bars</a></li>
                                        <li><a href='#'>clubs</a></li>
                                        <li><a href='#'>kafane</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#' data-hover="NEWS">NEWS</a>
                                </li>                               
                                <li>
                                    <a href='#' data-hover="CONTACT">CONTACT</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>               
            @show
            </div>
            
            @yield('content')
            
            <section id="footer" class="footer-section interstitial fullwidth space-y" data-section-name="contact-information">
                <div class="container">
                    <div class="col-xs-12">
                        <h4 class="text-uppercase">Belgrade Luxury</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">                       
                                <p>
                                    <a href="#">Services</a>
                                    <a href="#">Packages</a>
                                    <a href="#">Upcoming events</a>
                                    <a href="#">Blog</a>
                                </p>
                                <!--
                                <a href="{{ url("") }}">
                                    <img class="img-responsive" src="{{ url("") }}/images/logo/logo.svg" alt="Belgrade Luxury" />
                                </a>
                                <p class="text-justify">
                                    BELGRADE LUXURY offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure. 
                                </p>
                                -->
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <a href="#">About us</a>
                                    <a href="#">Contact</a>
                                    <a href="#">Become our partner</a>                       
                                    <a href="#">Terms and Conditions</a>
                                </p>
                            </div>                    
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-7">
                                <p> 
                                    <a href="#">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        Belgrade, Serbia
                                    </a>
                                    <a href="tel:+381644519017">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        (+381) 064 4519 017
                                    </a>
                                    <a href="mailto:office@belgradeluxury.com">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        office@belgradeluxury.com
                                    </a>
                                    <a href="mailto:inquiry@belgradeluxury.com">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        inquiry@belgradeluxury.com
                                    </a>
                                </p>
                            </div>

                            <div class="col-md-5 social">
                                <p>
                                    <a href="#">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>  
                                    <a href="#">
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>            
                </div>        
            </section>
    
        </div>
        
        
        <!-- scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
        <script src="{{ url("") }}/js/bootstrap.js"></script>       
        <script src="{{ url("") }}/js/animsition.min.js"></script>
        <script src="{{ url("") }}/js/jquery.scrollify.min.js"></script>
        <script src="{{ url("") }}/js/main.js"></script>
        @yield('scripts')
        
        
    </body>
    
</html>
