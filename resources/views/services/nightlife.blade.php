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
<title>@lang('titles.nightlife') - Belgrade Luxury</title>
<meta name="description" content="{{ trans_choice('services.nightlife', 1) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.nightlife') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ trans_choice('services.nightlife', 1) }}" />
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