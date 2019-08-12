@extends('layouts.master')

@section('stylesheets')
<link href="css/slick.css" rel="stylesheet" type="text/css">
<link href="css/slick-theme.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>
<!--    START VIDEO SECTION      -->
<section id="intro" class="video-section interstitial background-properties" data-section-name="intro-panel">
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
                    <h2 class="quotes"> @lang('index.quote1') </h2>
                    <h2 class="quotes"> @lang('index.quote2') </h2>
                    <h2 class="quotes"> BELGRADE <span> LUXURY </span> </h2>
                    <h2 class="quotes"> @lang('index.quote3') </h2>
                    <h2 class="quotes"> @lang('index.quote4') </h2>
                    <h2 class="quotes"> @lang('index.quote5') </h2>
                    <h1> @lang('index.quote6') </h1> 
                    <p> Simply Be Lux. </p>                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--    END VIDEO SECTION      -->

@if($promotions->first())
<!--    START SPECIAL OFFERS SECTION      -->
<section id="promotions" class="promotions-section interstitial fullwidth space-y" data-section-name="promotions-panel">
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.promotions') </h2>
            <p></p>
        </div>    
    </div>

    <div class="container">
        <div class="row">
            <div class="partner col-xs-12 text-center">
                <div class="img-holder">
                    <img src="{{ asset('storage/images/'.$promotions->first()->image) }}"
                         class="img-responsive" style="width: 100%"
                         alt="{{ $promotions->first()['title_'.$locale] }}" /> 
                </div>                                               
                <a href="{{ route("promotion", [ 'url' => str_replace(" ", "-", $promotions->first()['url_'.$locale]) ]) }}">                    
                    <h4 class="text-uppercase">{{ $promotions->first()['title_'.$locale] }}</h4>
                </a>
            </div>
        </div>
    </div> 
</section>
<!--    END SPECIAL OFFERS SECTION      -->
@endif

<!--    START TOP PICKS SECTION      -->
<section id="top-picks" class="top-picks-section interstitial fullwidth space-y" data-section-name="top-picks-panel">
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.top picks') </h2>
            <p></p>
        </div>    
    </div>
    
    <div id="upcoming-events" class="container-fluid"> 
        @include('top-picks-events', $events)
    </div>
    
    <div class="container-fluid"> 
        @include('top-picks-accommodation', ['accommodation' => $apartments])
    </div>
</section>
<!--    END TOP PICKS SECTION      -->

<!--    START PACKAGES SECTION      -->
<section id="select-package" class="packages-section widescreen panel space-y" data-section-name="select-package-panel">
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.packages') </h2>
            <p>
                {{ trans_choice('common.other packages', 0) }}
                <a href="{{ route("/") }}" class="">{{ trans_choice('common.other packages', 1) }}</a> 
                {{ trans_choice('common.other packages', 2) }}
                <a class="" href="{{ route("contact") }}">{{ trans_choice('common.other packages', 3) }}</a>
                {{ trans_choice('common.other packages', 4) }}
            </p>
        </div>    
    </div>
    <img class="gold-decor" src='{{ url("/") }}\images\decor.svg'>
        
    <div class="container-fluid">
        <div class="description text-center" id="package-info">
            <h6 class="text-uppercase">{{ trans_choice('common.current', 0) }} @lang('common.package')</h6>
            <h4 id="package-title" class="text-uppercase"> <span>{{ @trans_choice('common.luxury', 0) }}</span> @lang('common.package') </h4>
            <a id="inquiry" 
               class="btn" 
               data-href="{{ route("/").'/'.Lang::get('common.packages').'/'.Lang::get('common.inquiry').'/' }}"
               data-translation="{{ Lang::get('common.package') }}"> 
                @lang('common.send an inquiry') 
            </a>
            <a id="details" 
               class="btn"
               data-href="{{ route("/").'/'.Lang::get('common.packages').'/' }}"
               data-translation="{{ Lang::get('common.package') }}"> 
                @lang('common.details') 
            </a>
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
                <?php $i = 0; ?>
                @foreach($packages as $package)
                <figure id="{{ $i }}" class="{{ $package['title_'.$locale] }}">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <img id="{{ $package['title_'.$locale] }}" src="{{ asset('storage/images/'.$package->cardFront) }}" class="card" height="227px" width="363.5px" alt="{{ $package['title_'.$locale] }} {{ Lang::get('common.package') }}"/>
                            </div>
                            <div class="back">
                                <img src="{{ asset('storage/images/'.$package->cardFront) }}" class="card" height="227px" width="363.5px" alt="{{ $package['title_'.$locale] }} {{ Lang::get('common.package') }}" />
                            </div>
                        </div>
                    </div>                  
                </figure>
                <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="custom-package-container custom-package-section">
        <div class="container text-center">
            <div class="description">
                <h2 class="text-uppercase"> custom @lang('common.package') </h2>
                <p>
                    {{ trans_choice('common.custom package', 0) }} <i> {{ trans_choice('common.custom package', 1) }} </i>
                </p>                
            </div>
        </div>
        <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
        <div class="container-fluid text-center">
            <div class="text-uppercase">
                <div class="col-sm-4 step">
                    <img class="img-responsive" src='{{ url("/") }}\images\step1.svg' alt="{{ trans_choice('common.custom step',1) }}">
                    <h4>{{ trans_choice('common.custom step',1) }}</h4>
                </div>
                <div class="col-sm-4 step">
                    <img class="img-responsive" src='{{ url("/") }}\images\step2.svg' alt="{{ trans_choice('common.custom step',2) }}">
                    <h4>{{ trans_choice('common.custom step',2) }}</h4>
                </div>
                <div class="col-sm-4 step">
                    <img class="img-responsive" src='{{ url("/") }}\images\step3.svg' alt="{{ trans_choice('common.custom step',3) }}">
                    <h4>{{ trans_choice('common.custom step',3) }}</h4>
                </div>
            </div>
        </div>       
    </div>
</section>
<!--    END PACKAGES SECTION      -->

<!--    ABOUT US PANEL 1 SECTION      -->
<section id="about-us" class="aboutus-section box panel widescreen background-properties" data-section-name="about-us-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.about us')</h2>
                    <p>
                       {{ trans_choice('index.long about us', 0) }} 
                    </p>
                    <p>
                       {{ trans_choice('index.long about us', 1) }} 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    END ABOUT US PANEL 1 SECTION      -->

<!--    START BUSINESS SECTION      -->
<section id="business-services" class="business-section interstitial fullwidth space-y" data-section-name="business-services-panel">
    <div class="container-fluid text-center">
        <div class="description" style="padding: 0 10%; margin-bottom: 25px">
            <h2>@lang('index.business1')</h2>
        </div>
        <div class='row'>
            <div class="col-sm-4">
                <a class="btn" href="{{ route("package", [ 'title' => ucfirst(Lang::get('common.business')) ]) }}">
                    @lang('common.business') @lang('common.package')
                </a>
            </div>
            <div class="col-sm-4">
                <img class="img-responsive gold-ornament" style='position: absolute; left:-17px' src='<?php echo url("/")?>\images\ornament.svg'>
                <a class="btn" href="{{ route("contact") }}">
                    @lang('common.contact us')
                </a>
                <img class="img-responsive gold-ornament" style='position: absolute; right:-17px' src='<?php echo url("/")?>\images\ornament.svg'>
            </div>
            <div class="col-sm-4">
                <a class="btn" href="{{ route("business") }}">
                    {{ trans_choice('common.corporate',1) }} @lang('common.services')
                </a>
            </div>
        </div>
    </div>
</section>
<!--    END BUSINESS SECTION        -->

<!--    ABOUT US PANEL 2 SECTION      -->
<section id="business" class="aboutus-section box panel widescreen background-properties" data-section-name="business-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">{{ trans_choice('common.corporate',1) }} @lang('common.services')</h2>
                    <p>
                        @lang('index.business2')
                    </p>                   
                </div>
            </div>
        </div>
    </div>
</section>
<!--    END ABOUT US PANEL 2 SECTION      -->

<!--    ABOUT US PANEL 3 SECTION      -->
<section id="packages" class="aboutus-section box panel widescreen background-properties" data-section-name="packages-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.packages')</h2>
                    <p>
                        {{ trans_choice('index.packages', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('index.packages', 1) }}
                    </p>
                    <p>
                        {{ trans_choice('index.packages', 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    END ABOUT US PANEL 3 SECTION      -->

<!--    START ABOUT US SERVICES SECTION      -->
<section id="services" class="aboutus-section interstitial ribbon fullwidth space-y" data-section-name="services-panel">            
    <div class="container">
        <div class="description text-center" style='margin-bottom: 40px'>
            <h2 class="text-uppercase"> @lang('common.luxury vip services') </h2>
            <div class='row'>
                <div class='col-sm-4'>
                    <img class="img-responsive gold-ornament" src='<?php echo url("/")?>\images\ornament.svg'>
                </div>
                <div class='col-sm-4'>
                    <a id="contact" class="btn" href='{{ route("contact") }}'> @lang('common.contact us') </a>
                </div>
                <div class='col-sm-4'>
                    <img class="img-responsive gold-ornament" src='<?php echo url("/")?>\images\ornament.svg'>
                </div>
            </div>
            <p class="">
                @lang('index.short about us')
            </p>
        </div>       
    </div>    
    
    <div class="text-center text-uppercase">
        @foreach($services as $service)
        <div class="block" style="background-image: url('{{ url("") }}/images/services/{{ strtolower($service->name_en) }}.jpg')">
            <a href="{{ route(str_replace(" ", "-", strtolower($service->name_en))) }}">
                <h3>
                {{ $service['name_'.$locale] }}
                </h3>
            </a>
        </div>
        @endforeach        
    </div>
</section>
<!--    END ABOUT US SERVICES SECTION      -->

<!--    START BELGRADE SECTION      -->
<!--
<section id="belgrade" class="belgrade-section panel fullwidth" data-section-name="belgrade-panel">
    <section class="widescreen background-properties">
        <div class="overlay"></div>
        <div class="hero-holder">
            <div class="hero-inner">
                
            </div>
        </div>              
    </section>
    
    
</section>
-->
<!--    END BELGRADE SECTION      -->

<!--    START EVENTS SECTION      
<section id="events" class="events-section fullwidth interstitial space-y" data-section-name="events-panel">

    
    
</section>
<!--    END EVENTS SECTION      -->


<!--    START BELGRADE PERSPECTIVE SECTION      
<section id="belgrade-perspective" class="belgrade-perspective-section widescreen panel text-uppercase text-center" data-section-name="belgrade-perspective-panel">
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
<!--    END BELGRADE PERSPECTIVE SECTION      -->

<!--    START TESTEMONIALS SECTION      -->
<section id="testemonials" class="testemonials-section fullwidth interstitial space-y background-properties" data-section-name="testemonials-panel">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="carousel-holder text-center">
            <div class="testemonials-carousel">
                @foreach ($testemonials as $testemonial)
                <div class="slide text-left">
                    <p>
                        {{ $testemonial['content_'.$locale] }}
                    </p>
                    <div class="author row">   
                        @if ($testemonial->image != null)
                        <div class="col-xs-4">
                            <img class="img-responsive" src="{{ asset('storage/images/'.$testemonial->image) }}">
                        </div>
                        <div class="col-xs-8">
                        @else
                        <div class="col-xs-2">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-10">
                        @endif
                        @if ($testemonial->author != null)
                        <strong>{{ $testemonial->author }}</strong>, 
                        @endif
                        {{ $testemonial['profession_'.$locale] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>        
        </div>
    </div>
</section>
<!--    END TESTEMONIALS SECTION      -->
@stop

@section('scripts')
<script src="js/video.min.js"></script>
<script src="js/jquery.scrollify.min.js"></script>
<script src="js/reflection.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/home.min.js"></script>
@stop