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
<title>Belgrade Luxury - @lang('titles.nightlife') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury nightlife, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade nightlife, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route("nightlife") }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.nightlife') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury nightlife, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ url("/") }}/images/services/nightlife.jpg' />   
@stop

@section('stylesheets')

@stop

@section('content')
<!--   START NIGHTLIFE SERVICES DESCRIPTION PANEL SECTION      -->
<section id="nightlife" class="service-description-section box panel widescreen background-properties" data-section-name="nightlife-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.nightlife')</h2>
                    <p>
                        {{ trans_choice('services.nightlife', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.nightlife', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END NIGHTLIFE SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => false])

@include('services.list', ['service' => 'nightlife', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@include('services.script', ['types' => $types])
@stop