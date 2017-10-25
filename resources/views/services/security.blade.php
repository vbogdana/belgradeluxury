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
<title>@lang('titles.security') - Belgrade Luxury</title>
<meta name="description" content="{{ trans_choice('services.security', 0).trans_choice('services.security', 1) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.security') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ trans_choice('services.security', 0).trans_choice('services.security', 1) }}" />
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

@include('inquiry-section', ['service' => 'security'])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@stop