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
               
        @section('title-meta')
        <!-- page titles and meta tags -->
        <title>Belgrade Luxury - @lang('titles.index') </title>
        
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
        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-92215993-1', 'auto');
            ga('send', 'pageview');

        </script>        

        <!-- page content -->
        <div class='animsition'>
            <div class="menu wrapper text-lowercase" expanded="false">
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
                        <div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-4 col-md-offset-2">
                            <div class="col-xs-5 text-capitalize">
                                @lang('common.language'):
                            </div>
                            <div class="col-xs-7">
                                <ul>
                                    @section('language-toolbar')
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                    @endforeach
                                    @show
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 toolbar--show text-center">
                            <i class="fa fa-pulse fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            <!-- menu se definise ovde jer ce biti isti za sve stranice -->
            @section('sidebar')
                <nav class='navbar navbar-fixed-top'>
                    <div class='container'>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">@lang('common.toggle navigation')</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ route("/") }}">
                                <img src="{{ url("") }}/images/logo/logo-letters.svg" alt="Belgrade Luxury Logo"/>
                                <span class='text-uppercase'>@lang('common.home')</span>
                            </a>
                        </div>

                        <div id='navbar' class='navbar-collapse collapse'>
                            <ul class='nav navbar-nav '>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> @lang('common.services') <span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='{{ route("accommodation") }}'>@lang('common.accommodation')</a></li>
                                        <li><a href='{{ route("vehicles") }}'>@lang('common.vehicles')</a></li>
                                        <li><a href='#'>wellness & spa</a></li>
                                        <li><a href='#'>host</a></li>
                                        <li><a href='#'>@lang('common.security')</a></li>
                                        <li><a href='#'>@lang('common.reservations')</a></li>
                                        <li><a href='#'>@lang('common.events')</a></li>
                                        <li><a href='#'>@lang('common.business')</a></li>
                                        <li><a href='#'>@lang('common.personel')</a></li>
                                        <li><a href='#'>@lang('common.nightlife')</a></li>
                                        <li><a href='#'>@lang('common.sightseeing')</a></li>
                                        <li><a href='#'>diamond</a></li>
                                    </ul>
                                </li>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> @lang('common.packages') <span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='#'>luxury</a></li>
                                        <li><a href='#'>diamond</a></li>
                                        <li><a href='#'>spa</a></li>
                                        <li><a href='#'>bachelor</a></li>
                                        <li><a href='#'>party</a></li>
                                        <li><a href='#'>business</a></li>
                                        <li><a href='#'>custom @lang('common.package')</a></li>
                                    </ul>
                                </li>
                                <li class='dropdown'>
                                    <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">blog<span class="caret"></span></a>
                                    <ul class='dropdown-menu'>
                                        <li><a href='#'>@lang('common.culture')</a></li>
                                        <li><a href='#'>@lang('common.social')</a></li>
                                        <li><a href='#'>@lang('common.gastronomy')</a></li>
                                        <li><a href='#'>@lang('common.nightlife')</a></li>
                                        <li><a href='#'>@lang('common.tourism')</a></li>
                                        <li><a href='#'>@lang('common.upcoming') @lang('common.events')</a></li>
                                    </ul>
                                </li>                              
                                <li>
                                    <a href='{{ route("contact") }}'>@lang('common.contact')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>               
            @show
            </div>
            
            @yield('content')
            
            <section id="quick-links" class="footer-section interstitial fullwidth space-y" data-section-name="quick-links-panel">
                <div class="container">
                    <div class="col-xs-12">
                        <h4 class="text-uppercase">Belgrade Luxury</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">                       
                                <p>
                                    <a class="link" data-scroll href="{{ route("/") }}#services">@lang('common.services')</a>
                                    <a class="link" data-scroll href="{{ route("/") }}#packages">@lang('common.packages')</a>
                                    <a class="link" data-scroll href="{{ route("/") }}#upcoming-events">@lang('common.upcoming') @lang('common.events')</a>
                                    <a class="link" href="#">Blog</a>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <a class="link" data-scroll href="{{ route("/") }}#about-us">@lang('common.about us')</a>
                                    <a class="link" href="{{ route("contact") }}">@lang('common.contact')</a>
                                    <a class="link" href="#">@lang('common.partners')</a>                       
                                    <a class="link" href="#">@lang('common.terms and conditions')</a>
                                </p>
                            </div>                    
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-7">
                                <p> 
                                    <a class="link" href="#">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        @lang('common.belgrade'), @lang('common.serbia')
                                    </a>
                                    <a class="link" href="tel:+381644519017">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        (+381) 064 4519 017
                                    </a>
                                    <a class="link" href="mailto:office@belgradeluxury.com">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        office@belgradeluxury.com
                                    </a>
                                    <a class="link" href="mailto:inquiry@belgradeluxury.com">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        inquiry@belgradeluxury.com
                                    </a>
                                </p>
                            </div>

                            <div class="col-md-5 social">
                                <div class="hi-icon-wrap hi-icon-effect">					
                                    <a href="http://www.facebook.com/belgradeluxury" target="blank" class="hi-icon fa-facebook"></a>
                                    <a href="http://www.instagram.com/belgradeluxury" target="blank" class="hi-icon fa-instagram"></a>  
                                    <a href="#" class="hi-icon fa-youtube-play"></a>                                   
                                    <a id="whatsapp" href="" class="hi-icon fa-whatsapp"></a>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>        
            </section>
    
        </div>
        <!-- Animsition -->
        
        
        <!-- scripts -->     
        <script src="{{ url("") }}/js/jquery-3.1.1.min.js"></script>
        <script>
            url = "https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js";
            $.getScript(url);
        </script>
        <script src="{{ url("") }}/js/bootstrap.js"></script>       
        <script src="{{ url("") }}/js/animsition.min.js"></script>
        <script src="{{ url("") }}/js/jquery.scrollify.min.js"></script>        
        <script src="{{ url("") }}/js/smooth-scroll.js"></script>
        <script src="{{ url("") }}/js/main.js"></script>
        @yield('scripts')
        
        <!-- Detecting the OS -->
        <script>
            var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            var android = /Android/.test(navigator.userAgent) && !window.MSStream;
            var url;
            if (android) {
                url = "intent://send/+381644519017#Intent;scheme=smsto;package=com.whatsapp;action=android.intent.action.SENDTO;end"; 
                //maps_protocol = 'http://maps.google.com/maps';
            } else if (iOS) {
                url = "whatsapp://send";
                //maps_protocol = 'maps://';
            } else {
                url = "tel:+381644519017";
                //maps_protocol = 'http://www.google.com/maps/place/';
            }
            $('#whatsapp').attr({
                href: url
            });
            maps_protocol = 'http://maps.apple.com/?q=';
             
            $('.fa-map-marker').each(function() {
                geoLoc = $(this).attr('href');
                $(this).attr({
                    href: maps_protocol + geoLoc
                });
            });
        </script>
       
    </body>
    
</html>
