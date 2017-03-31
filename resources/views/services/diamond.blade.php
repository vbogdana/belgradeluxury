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
<title>Belgrade Luxury - @lang('titles.diamond') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route("diamond") }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.diamond') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ url("/") }}/images/services/diamond.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START DIAMOND SERVICES DESCRIPTION PANEL SECTION      -->
<section id="diamond" class="service-description-section box panel widescreen background-properties" data-section-name="diamond-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float: right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">diamond</h2>
                    <p>
                        {{ trans_choice('services.diamond', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.diamond', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END DIAMOND SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<section id='service-info' class='service-info-section fullwidth panel space-y' data-section-name='service-info-panel'>
<!--
    OVDE IDE SADRZAJ SEKCIJE, TJ OPIS USLUGA
-->    
</section>

@include('inquiry-section')

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')

@stop