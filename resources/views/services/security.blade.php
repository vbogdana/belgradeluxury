<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - 
-->
@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>Belgrade Luxury - @lang('titles.security') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route("security") }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.security') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ url("/") }}/images/services/security.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START SECURITY SERVICES DESCRIPTION PANEL SECTION      -->
<section id="security-first" class="service-description-section box panel widescreen background-properties" data-section-name="security-first-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.security')</h2>
                    <p>
                        {{ trans_choice('services.security', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.security', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END SECURITY SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<!--   START SECURITY SERVICES DESCRIPTION PANEL SECTION      -->
<section id="security-second" class="service-description-section box panel widescreen background-properties" data-section-name="security-second-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.security')</h2>
                    <p>
                        {{ trans_choice('services.security', 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END SECURITY SERVICES DESCRIPTION SECTION      -->

@include('inquiry-section')

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@stop