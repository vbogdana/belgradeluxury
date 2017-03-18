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
<title>Belgrade Luxury - @lang('titles.vehicles') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade vehicles, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route("vehicles") }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.vehicles') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ url("/") }}/images/services/vehicles.jpg' />   
@stop

@section('stylesheets')

@stop

@section('content')
<!--   START VEHICLES SERVICES DESCRIPTION PANEL SECTION      -->
<section id="vehicles" class="service-description-section box panel widescreen background-properties" data-section-name="vehicles-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.vehicles')</h2>
                    <p>
                        {{ trans_choice('services.vehicles', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.vehicles', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END VEHICLES SERVICES DESCRIPTION SECTION      -->

@include('inquiry-section')

@include('services.list', ['service' => 'vehicles', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@include('services.script', ['types' => $types])
@stop