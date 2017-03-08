<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>Belgrade Luxury - @lang('titles.host') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ LaravelLocalization::getLocalizedURL() }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.host') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ route("/") }}/images/services/host.jpg' />   
@stop

@section('stylesheets')

@stop

@section('content')
<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>
<!--   START HOST SERVICES DESCRIPTION PANEL SECTION      -->
<section id="host" class="service-description-section box panel widescreen background-properties" data-section-name="host-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.host')</h2>
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
<!--   END HOST SERVICES DESCRIPTION SECTION      -->

<!--   START INQUIRY SECTION      -->
<section id="inquiry" class="service-inquiry-section interstitial ribbon fullwidth space-y" data-section-name="inquiry-panel">            
    <img class="gold-decor" src='<?php echo url("/")?>/images/decor.svg'>
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">@lang('common.luxury vip services')</h2>
            <div class='col-xs-6 col-sm-offset-3 col-sm-3 col-md-offset-4 col-md-2'>
            <a id="contact" class="btn" href='{{ route("contact") }}'> @lang('common.contact us') </a>
            </div>
            <div class='col-xs-6 col-sm-3 col-md-2'>
            <a id="inquiry" class="btn" href='{{ route("contact") }}#contact-us'> @lang('common.inquiry') </a>
            </div>
        </div>      
    </div>   
</section>
<!--   END INQUIRY SECTION      -->

<!--   START HOSTS SECTION      -->
<section id="all-hosts" class="host-section panel fullwidth space-y" data-section-name="all-hosts-panel">            
    
    <div class="container-fluid text-center">
        <div class="row">
        @foreach ($hosts as $host)
            <div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4 col-lg-offset-5 col-lg-2">          
                @if ($host->image != null)
                <img class="img-responsive img-circle" src="{{ asset('storage/images/'.$host->image) }}">
                @else
                <i class="fa fa-user-o" aria-hidden="true"></i>
                @endif
            </div>
            <div class="col-xs-12 col-sm-offset-3 col-sm-6">
                <h4 class="text-uppercase">{{ $host->name }}</h4>
                <?php
                    $skills = explode(";", $host['skills_'.$locale]);
                ?>
                <p>
                    <ul>
                    @foreach ($skills as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                    </ul>
                </p>
            </div>   
        @endforeach
        </div>
 
    </div>  
    
</section>
<!--   END HOSTS SECTION      -->

<!--   START PACKAGES SECTION      -->
<section id="packages" class="other-packages-section interstitial ribbon fullwidth space-y" data-section-name="packages-panel">            
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">@lang('common.packages')</h2>
            <p>
                {{ trans_choice('common.other packages', 0) }}
                <a href="{{ route("/") }}" class="">{{ trans_choice('common.other packages', 1) }}</a> 
                {{ trans_choice('common.other packages', 2) }}
                <a class="" href="#">{{ trans_choice('common.other packages', 3) }}</a>
                {{ trans_choice('common.other packages', 4) }}
            </p>
        </div>    
    </div>
    <img class="gold-decor" src='{{ url("/") }}/images/decor.svg'>
    <div class="container-fluid">
        <div class="row">
            @foreach ($packages as $package)
            <div class="col-xs-6 col-sm-4 col-lg-2" style='margin: 20px 0 20px'>
                <a href='#'>
                    <img class='img-responsive' src='{{ asset('storage/images/'.$package->symbol) }}'>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--   END PACKAGES SECTION      -->

<!--   START CUSTOM PACKAGE SECTION      -->
<section id="custom-package" class="custom-package-section interstitial ribbon fullwidth space-y" data-section-name="custom-package-panel">            
    <div class="container text-center">
        <div class="description">
            <h2 class="text-uppercase"> custom @lang('common.package') </h2>
            <p>
                {{ trans_choice('common.custom package', 0) }} <i> {{ trans_choice('common.custom package', 1) }} </i>
            </p>                
        </div>
    </div>
    <img class="gold-decor" src='{{ url("/") }}/images/decor.svg'>
    <div class="container text-center">
        <div class="text-uppercase">
            <div class="col-sm-4">
                {{ trans_choice('common.custom step',1) }}
            </div>
            <div class="col-sm-4">
                {{ trans_choice('common.custom step',2) }}
            </div>
            <div class="col-sm-4">
                {{ trans_choice('common.custom step',3) }}!
            </div>
        </div>
    </div>
</section>
<!--   END CUSTOM PACKAGE SECTION      -->
@stop

@section('scripts')
@stop