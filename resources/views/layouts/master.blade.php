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
        
        <!-- favicons 
        <link rel="icon" href="<?php echo url("") ?>/images/logo-bl-white.ico"  type="image/x-icon" /> 
        -->
        
        <!-- scripts -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/animsition.min.css" rel="stylesheet" type="text/css">       
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
                                    <span>inquiry@belgradeluxury.com</span>
                                </a>                               
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <a href="tel:+381644519017">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>(+381) 064 4519 017</span>
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
                            <a class="navbar-brand" href="#">
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
                                        <li><a href='#'>chauffeur</a></li>
                                        <li><a href='#'>host</a></li>
                                        <li><a href='#'>security</a></li>
                                        <li><a href='#'>reservations</a></li>
                                        <li><a href='#'>events</a></li>
                                        <li><a href='#'>nightlife</a></li>
                                        <li><a href='#'>sightseeing</a></li>
                                        <li><a href='#'>diamond</a></li>
                                    </ul>
                                </li>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-hover="PACKAGES">PACKAGES <span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='#'>luxury</a></li>
                                        <li><a href='#'>VIP luxury</a></li>
                                        <li><a href='#'>bachelor</a></li>
                                        <li><a href='#'>bachelor penthouse</a></li>
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
            
            <section class="fullwidth panel space-y">
                <div class="container">
                    <div class="col-sm-3">
                        <a href="<?php echo url('/') ?>">
                            <img class="img-responsive" src="{{ url("") }}/images/logo/logo.svg" alt="Belgrade Luxury" />
                        </a>
                        <p>
                            BELGRADE LUXURY offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure, for one price. 
                            <br />
                            Simply Be Lux.
                        </p>
                    </div>
                    <div class="col-sm-3">
                
                    </div>
                    <div class="col-sm-3">
                        <h3>Contact us</h3>
                                
                        <h4>BELGRADE LUXURY</h4>
                        <address>
                            <p> 
                                <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Republic Square<br/>
                                11000 Belgrade SERBIA <br/>
                                <a href="tel:+381644519017">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>(+381) 064 4519 017</span>
                                </a>
                                <br/>
                                <a href="mailto:office@belgradeluxury.com">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <span>office@belgradeluxury.com</span>
                                </a>
                                <br />
                                <a href="mailto:inquiry@belgradeluxury.com">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <span>inquiry@belgradeluxury.com</span>
                                </a>
                            </p>
                        </address>
                    </div>
                    <div class="col-sm-3">
                
                    </div>            
                </div>        
            </section>
    
        </div>
        
        
        <!-- scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
        <script src="js/bootstrap.js"></script>       
        <script src="js/animsition.min.js"></script>
        <script src="js/main.js"></script>
        @yield('scripts')
        
        
    </body>
    
</html>
