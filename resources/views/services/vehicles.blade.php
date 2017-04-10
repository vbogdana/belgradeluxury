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
<title>@lang('titles.vehicles') - Belgrade Luxury</title>
<meta name="description" content="{{ trans_choice('services.vehicles', 0).trans_choice('services.vehicles', 1) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.vehicles') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ trans_choice('services.vehicles', 0).trans_choice('services.vehicles', 1) }}" />
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

@include('contact-us-section', ['inquiry' => false])

@include('services.list', ['service' => 'vehicles', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@include('services.script', ['types' => $types])
@stop